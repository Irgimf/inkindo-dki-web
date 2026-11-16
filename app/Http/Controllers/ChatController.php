<?php

namespace App\Http\Controllers;

use App\Support\SiteContactHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    private function ensureMemoryTable(): void
    {
        if (Schema::hasTable('ai_memories')) {
            return;
        }

        try {
            DB::statement("
                CREATE TABLE IF NOT EXISTS `ai_memories` (
                    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `trigger_keywords` VARCHAR(255) NULL DEFAULT NULL,
                    `question_context` VARCHAR(500) NULL DEFAULT NULL,
                    `memory_note` TEXT NOT NULL,
                    `created_by` BIGINT UNSIGNED NULL DEFAULT NULL,
                    `created_at` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");
        } catch (\Throwable $e) {
        }
    }

    private function isAdminUser(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        return $user && in_array((string) $user->role, ['admin', 'super_admin'], true);
    }

    private function handleAdminMemoryCommand(string $message, array $history): ?string
    {
        if (!$this->isAdminUser()) {
            return null;
        }

        $this->ensureMemoryTable();
        $trimmed = trim($message);
        $lower   = mb_strtolower($trimmed);

        // Perintah hapus koreksi terakhir
        if (preg_match('/^(hapus\s+koreksi\s+terakhir|reset\s+koreksi\s+terakhir)$/u', $lower)) {
            $last = DB::table('ai_memories')->orderByDesc('id')->first();
            if ($last) {
                DB::table('ai_memories')->where('id', $last->id)->delete();
                return "Koreksi terakhir (\"{$last->memory_note}\") berhasil dihapus dari memori AI.";
            }
            return "Saat ini belum ada data koreksi di memori AI.";
        }

        // Deteksi format eksplisit ("Koreksi: ...", "Ingat: ...", "Catatan AI: ...")
        // atau kalimat koreksi alami dari Admin ("seharusnya ...", "bukan itu ...", "jawaban yang benar/tepat ...", "cukup jawab ...")
        $noteContent = null;
        if (preg_match('/^(?:koreksi|ingat|catatan\s*ai|simpan\s*info)\s*:\s*(.+)$/isu', $trimmed, $m)) {
            $noteContent = trim($m[1]);
        } elseif (preg_match('/^(?:bukan\s+itu[,.\s]+)?(?:seharusnya(?:\s+jawabannya)?|jawaban\s+yang\s+(?:benar|tepat)(?:\s+adalah)?|yang\s+(?:benar|tepat)\s+adalah|cukup\s+jawab)\s*[:\-]?\s*(.+)$/isu', $trimmed, $m)) {
            $noteContent = trim($m[1]);
        }

        if ($noteContent === null || mb_strlen($noteContent) < 5) {
            return null;
        }

        // Cari pertanyaan user terakhir dari history sebagai konteks pemicu
        $lastUserQuestion = '';
        for ($i = count($history) - 1; $i >= 0; $i--) {
            if (($history[$i]['role'] ?? '') === 'user') {
                $candidate = trim((string) ($history[$i]['text'] ?? ''));
                if ($candidate !== '' && !preg_match('/^(?:koreksi|ingat|catatan\s*ai|bukan\s+itu|seharusnya|cukup\s+jawab)/isu', $candidate)) {
                    $lastUserQuestion = $candidate;
                    break;
                }
            }
        }

        $kwSource = $lastUserQuestion !== '' ? ($lastUserQuestion . ' ' . $noteContent) : $noteContent;
        $kws = $this->extractKeywords($kwSource);

        DB::table('ai_memories')->insert([
            'trigger_keywords' => implode(',', $kws),
            'question_context' => $lastUserQuestion !== '' ? Str::limit($lastUserQuestion, 480, '') : null,
            'memory_note'      => $noteContent,
            'created_by'       => Auth::id(),
            'created_at'       => now(),
        ]);

        $ctxInfo = $lastUserQuestion !== '' ? " untuk pertanyaan \"{$lastUserQuestion}\"" : '';
        return "Terima kasih! Koreksi Anda{$ctxInfo} telah saya simpan secara permanen ke memori AI:\n\"{$noteContent}\"\n\nMulai sekarang saya akan mengikuti arahan tersebut saat menjawab pertanyaan terkait.";
    }

    public function reply(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message'        => ['required', 'string', 'max:2000'],
            'history'        => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['nullable', 'in:user,model'],
            'history.*.text' => ['nullable', 'string', 'max:5000'],
        ]);

        $message = trim($validated['message']);
        $history = is_array($validated['history'] ?? null) ? $validated['history'] : [];

        // Jika Admin memberikan koreksi/pengetahuan baru di chat, simpan permanen ke DB
        $adminMemoryResponse = $this->handleAdminMemoryCommand($message, $history);
        if ($adminMemoryResponse !== null) {
            return response()->json([
                'reply'  => $adminMemoryResponse,
                'source' => 'memory_saved',
            ]);
        }

        $keywords = $this->extractKeywords($message);
        $contextData = $this->buildWebsiteContext($message, $keywords);

        $apiKey = trim((string) config('services.gemini.key', ''));
        $model  = trim((string) config('services.gemini.model', 'gemini-3.8-flash')) ?: 'gemini-3.8-flash';

        if ($apiKey !== '') {
            $aiReply = $this->callGemini($apiKey, $model, $message, $history, $contextData);
            if ($aiReply !== null) {
                return response()->json([
                    'reply'  => $aiReply,
                    'source' => 'gemini',
                ]);
            }
        }

        $fallbackReply = $this->buildSmartDatabaseReply($message, $keywords, $contextData, $history);
        return response()->json([
            'reply'  => $fallbackReply,
            'source' => 'database',
        ]);
    }

    private function extractKeywords(string $text): array
    {
        $clean = mb_strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text));
        $parts = preg_split('/\s+/', trim($clean)) ?: [];

        // Kata umum & nama organisasi yang muncul di hampir semua berita/SBU
        $stopwords = [
            'apa', 'apakah', 'ada', 'berapa', 'bagaimana', 'gimana', 'siapa', 'mana', 'kapan',
            'yang', 'yg', 'di', 'ke', 'dari', 'dan', 'atau', 'untuk', 'dengan', 'pada', 'ini', 'itu',
            'saya', 'aku', 'kami', 'kita', 'tolong', 'info', 'informasi', 'tentang', 'mengenai',
            'bisa', 'tidak', 'nggak', 'gak', 'ya', 'halo', 'hai', 'selamat', 'pagi', 'siang', 'sore', 'malam',
            'pernah', 'menangani', 'proyek', 'kegiatan', 'acara', 'bulan', 'tahun', 'mitra', 'kerja',
            'anggota', 'daftar', 'mendaftar', 'terdaftar', 'cara', 'pt', 'cv', 'perusahaan', 'badan', 'usaha',
            'sbu', 'jasa', 'kualifikasi', 'kelas', 'kecil', 'menengah', 'besar',
            'mempunyai', 'punya', 'memiliki', 'saat', 'saja', 'daerah', 'wilayah', 'lokasi',
            'jakarta', 'dki', 'inkindo', 'dpp', 'jumlah', 'total',
            'what', 'how', 'many', 'is', 'are', 'the', 'in', 'of', 'for', 'and',
        ];

        $keywords = [];
        foreach ($parts as $word) {
            if (mb_strlen($word) >= 3 && !in_array($word, $stopwords, true)) {
                $keywords[] = $word;
            }
        }

        return array_values(array_unique(array_slice($keywords, 0, 10)));
    }

    private function buildWebsiteContext(string $message, array $keywords): array
    {
        $contact = SiteContactHelper::get();
        $contactInfo = [
            'alamat'          => (string) ($contact->alamat ?? ''),
            'telepon_1'       => (string) ($contact->telepon_1 ?? ''),
            'telepon_2'       => (string) ($contact->telepon_2 ?? ''),
            'fax'             => (string) ($contact->fax ?? ''),
            'email_1'         => (string) ($contact->email_1 ?? ''),
            'email_2'         => (string) ($contact->email_2 ?? ''),
            'jam_operasional' => (string) ($contact->jam_operasional ?? ''),
            'bio'             => (string) ($contact->bio ?? ''),
        ];

        // 1. Mitra Kerja Aktif & Produk
        $mitraTotal = 0;
        $mitraList = [];
        if (Schema::hasTable('mitra_kerja')) {
            try {
                $mq = DB::table('mitra_kerja')->orderBy('id', 'asc');
                if (Schema::hasColumn('mitra_kerja', 'status_kemitraan')) {
                    $mq->where('status_kemitraan', 'active');
                }
                if (Schema::hasColumn('mitra_kerja', 'expired_at')) {
                    $mq->where(function ($q) {
                        $q->whereNull('expired_at')->orWhere('expired_at', '>=', date('Y-m-d'));
                    });
                }
                $mitraRows = $mq->get(['id', 'nama_perusahaan', 'kategori_bisnis', 'alamat', 'telepon', 'email', 'website']);
                $mitraTotal = $mitraRows->count();

                $productsMap = [];
                if (Schema::hasTable('mitra_products')) {
                    $pRows = DB::table('mitra_products')->get(['mitra_id', 'nama_produk', 'kategori_produk']);
                    foreach ($pRows as $pr) {
                        $productsMap[(int) $pr->mitra_id][] = $pr->nama_produk . ($pr->kategori_produk ? " ({$pr->kategori_produk})" : '');
                    }
                }

                foreach ($mitraRows->take(40) as $m) {
                    $mitraList[] = [
                        'nama'     => $m->nama_perusahaan,
                        'kategori' => $m->kategori_bisnis ?: 'Mitra Kerja',
                        'alamat'   => $m->alamat ?: '-',
                        'telepon'  => $m->telepon ?: '-',
                        'website'  => $m->website ?: '-',
                        'produk'   => array_slice($productsMap[(int) $m->id] ?? [], 0, 5),
                    ];
                }
            } catch (\Throwable $e) {
            }
        }

        // 2. Berita, Agenda Kegiatan, Publikasi, e-Magazine, Galeri, Karya
        $beritaItems = [];
        $monthMatchedBerita = [];
        $detectedMonthName = null;
        $lowerMsg = mb_strtolower($message);

        // Deteksi filter kualifikasi spesifik (Kecil / Menengah / Besar)
        $askedKualifikasi = null;
        if (preg_match('/\bkecil\b/u', $lowerMsg)) {
            $askedKualifikasi = 'Kecil';
        } elseif (preg_match('/\bmenengah\b/u', $lowerMsg)) {
            $askedKualifikasi = 'Menengah';
        } elseif (preg_match('/\bbesar\b/u', $lowerMsg)) {
            $askedKualifikasi = 'Besar';
        }

        // Jika pengguna menanyakan "kegiatan" / "agenda" / "acara", jangan masukkan e-Magazine atau Publikasi buku/pedoman
        $isAskingKegiatanOnly = (bool) preg_match('/\b(kegiatan|agenda|acara)\b/u', $lowerMsg)
            && !preg_match('/\b(majalah|emagazine|magazine|publikasi|buku|pedoman)\b/u', $lowerMsg);

        if (Schema::hasTable('cms_berita')) {
            try {
                $monthMap = [
                    'januari'   => ['num' => '01', 'short' => 'jan'],
                    'februari'  => ['num' => '02', 'short' => 'feb'],
                    'maret'     => ['num' => '03', 'short' => 'mar'],
                    'april'     => ['num' => '04', 'short' => 'apr'],
                    'mei'       => ['num' => '05', 'short' => 'mei'],
                    'juni'      => ['num' => '06', 'short' => 'jun'],
                    'juli'      => ['num' => '07', 'short' => 'jul'],
                    'agustus'   => ['num' => '08', 'short' => 'agu'],
                    'september' => ['num' => '09', 'short' => 'sep'],
                    'oktober'   => ['num' => '10', 'short' => 'okt'],
                    'november'  => ['num' => '11', 'short' => 'nov'],
                    'desember'  => ['num' => '12', 'short' => 'des'],
                ];
                $detectedMonthNum = null;
                $detectedMonthShort = null;
                foreach ($monthMap as $mName => $mMeta) {
                    if (preg_match('/\b(' . $mName . '|' . $mMeta['short'] . ')\b/u', $lowerMsg)) {
                        $detectedMonthName = $mName;
                        $detectedMonthNum = $mMeta['num'];
                        $detectedMonthShort = $mMeta['short'];
                        break;
                    }
                }

                $beritaQuery = DB::table('cms_berita')
                    ->orderByDesc('tanggal')
                    ->orderByDesc('id');

                if ($isAskingKegiatanOnly) {
                    $beritaQuery->whereIn('tipe', ['agenda', 'rilis', 'galeri']);
                }

                $allBerita = $beritaQuery
                    ->limit(60)
                    ->get(['tipe', 'judul', 'tanggal', 'tanggal_label', 'kategori_label', 'ringkasan']);

                foreach ($allBerita as $b) {
                    $entry = [
                        'tipe'      => $b->tipe,
                        'judul'     => $b->judul,
                        'tanggal'   => $b->tanggal_label ?: $b->tanggal,
                        'kategori'  => $b->kategori_label,
                        'ringkasan' => Str::limit(strip_tags((string) ($b->ringkasan ?? '')), 140),
                    ];

                    $matchesKeyword = false;
                    $tglLabelLower = mb_strtolower((string) ($b->tanggal_label ?? ''));
                    if ($detectedMonthName !== null) {
                        $inLabel = $tglLabelLower !== '' && (
                            str_contains($tglLabelLower, $detectedMonthName)
                            || (bool) preg_match('/\b' . $detectedMonthShort . '\b/u', $tglLabelLower)
                        );
                        $inDate = str_contains((string) $b->tanggal, '-' . $detectedMonthNum . '-');
                        if ($inLabel || ($tglLabelLower === '' && $inDate)) {
                            $matchesKeyword = true;
                        }
                    } elseif (!empty($keywords)) {
                        $haystack = mb_strtolower($b->judul . ' ' . $b->ringkasan . ' ' . $b->tanggal_label);
                        foreach ($keywords as $kw) {
                            if (str_contains($haystack, $kw)) {
                                $matchesKeyword = true;
                                break;
                            }
                        }
                    }

                    if ($matchesKeyword && count($monthMatchedBerita) < 12) {
                        $monthMatchedBerita[] = $entry;
                    }
                    if (count($beritaItems) < 12) {
                        $beritaItems[] = $entry;
                    }
                }
            } catch (\Throwable $e) {
            }
        }

        // 3. Perusahaan Anggota, SBU & Proyek (companies, members, sbu, sbu_projects)
        $memberStats = ['total' => 0, 'besar' => 0, 'menengah' => 0, 'kecil' => 0];
        $companyList = [];
        $matchedCompanies = [];
        $matchedSbus = [];
        $matchedProjects = [];

        if (Schema::hasTable('companies')) {
            try {
                $memberStats['total']    = DB::table('companies')->count();
                $memberStats['besar']    = DB::table('companies')->where('kualifikasi', 'Besar')->count();
                $memberStats['menengah'] = DB::table('companies')->where('kualifikasi', 'Menengah')->count();
                $memberStats['kecil']    = DB::table('companies')->where('kualifikasi', 'Kecil')->count();

                $companyList = DB::table('companies')
                    ->orderBy('id', 'asc')
                    ->limit(50)
                    ->get(['id', 'nama_pt', 'nama_pjbu', 'no_kta', 'kualifikasi', 'wilayah', 'alamat_pt', 'kategori_sbu', 'status', 'telepon', 'email'])
                    ->toArray();

                if (!empty($keywords)) {
                    $cq = DB::table('companies');
                    $cq->where(function ($q) use ($keywords) {
                        foreach ($keywords as $kw) {
                            $like = '%' . $kw . '%';
                            $q->orWhere('nama_pt', 'like', $like)
                              ->orWhere('no_kta', 'like', $like)
                              ->orWhere('wilayah', 'like', $like)
                              ->orWhere('alamat_pt', 'like', $like)
                              ->orWhere('kualifikasi', 'like', $like)
                              ->orWhere('kategori_sbu', 'like', $like);
                        }
                    });
                    $matchedCompanies = $cq->limit(20)->get(['nama_pt', 'no_kta', 'kualifikasi', 'wilayah', 'alamat_pt', 'kategori_sbu', 'status'])->toArray();
                }
            } catch (\Throwable $e) {
            }
        }

        if ($memberStats['total'] === 0 && Schema::hasTable('members')) {
            try {
                $memberStats['total']    = DB::table('members')->count();
                $memberStats['besar']    = DB::table('members')->where('kualifikasi', 'Besar')->count();
                $memberStats['menengah'] = DB::table('members')->where('kualifikasi', 'Menengah')->count();
                $memberStats['kecil']    = DB::table('members')->where('kualifikasi', 'Kecil')->count();
            } catch (\Throwable $e) {
            }
        }

        if (Schema::hasTable('sbu') && Schema::hasTable('companies')) {
            try {
                $sq = DB::table('sbu as s')
                    ->join('companies as c', 's.company_id', '=', 'c.id')
                    ->select('c.nama_pt', 'c.no_kta', 'c.wilayah', 'c.alamat_pt', 'c.kualifikasi as company_kualifikasi', 's.jenis_sbu', 's.kode_kbli', 's.judul_kbli', 's.kualifikasi', 's.masa_berlaku');

                if ($askedKualifikasi !== null) {
                    $sq->where(function ($q) use ($askedKualifikasi) {
                        $q->where('s.kualifikasi', $askedKualifikasi)
                          ->orWhere(function ($sub) use ($askedKualifikasi) {
                              $sub->whereNull('s.kualifikasi')->where('c.kualifikasi', $askedKualifikasi);
                          });
                    });
                }

                if (!empty($keywords)) {
                    $sq->where(function ($q) use ($keywords) {
                        foreach ($keywords as $kw) {
                            $like = '%' . $kw . '%';
                            $q->orWhere('s.judul_kbli', 'like', $like)
                              ->orWhere('s.kode_kbli', 'like', $like)
                              ->orWhere('c.nama_pt', 'like', $like);
                        }
                    });
                }

                $rawSbus = $sq->limit(30)->get()->toArray();
                if (!empty($keywords) && count($rawSbus) > 1) {
                    // Urutkan berdasarkan jumlah kata kunci yang paling banyak cocok agar SBU yang spesifik muncul paling atas
                    $scored = [];
                    $maxScore = 0;
                    foreach ($rawSbus as $row) {
                        $hay = mb_strtolower(($row->judul_kbli ?? '') . ' ' . ($row->kode_kbli ?? '') . ' ' . ($row->nama_pt ?? ''));
                        $score = 0;
                        foreach ($keywords as $kw) {
                            if (str_contains($hay, $kw)) {
                                $score++;
                            }
                        }
                        if ($score > $maxScore) {
                            $maxScore = $score;
                        }
                        $scored[] = ['score' => $score, 'row' => $row];
                    }
                    $threshold = max(1, (int) ceil($maxScore * 0.75));
                    $filtered = array_filter($scored, fn ($item) => $item['score'] >= $threshold);
                    usort($filtered, fn ($a, $b) => $b['score'] <=> $a['score']);
                    $matchedSbus = array_map(fn ($item) => $item['row'], array_slice($filtered, 0, 10));
                } else {
                    $matchedSbus = array_slice($rawSbus, 0, 10);
                }
            } catch (\Throwable $e) {
            }
        }

        if (Schema::hasTable('sbu_projects') && Schema::hasTable('sbu') && Schema::hasTable('companies')) {
            try {
                $pq = DB::table('sbu_projects as p')
                    ->join('sbu as s', 'p.sbu_id', '=', 's.id')
                    ->join('companies as c', 's.company_id', '=', 'c.id')
                    ->select('c.nama_pt', 'c.no_kta', 's.kode_kbli', 's.judul_kbli', 'p.nama_pekerjaan', 'p.nilai_proyek', 'p.tahun_proyek', 'p.lama_proyek');

                if (!empty($keywords)) {
                    $pq->where(function ($q) use ($keywords) {
                        foreach ($keywords as $kw) {
                            $like = '%' . $kw . '%';
                            $q->orWhere('p.nama_pekerjaan', 'like', $like)
                              ->orWhere('c.nama_pt', 'like', $like)
                              ->orWhere('s.judul_kbli', 'like', $like)
                              ->orWhere('s.kode_kbli', 'like', $like);
                        }
                    });
                }

                $matchedProjects = $pq->limit(20)->get()->toArray();
            } catch (\Throwable $e) {
            }
        }

        // 4. Regulasi & Info Lelang
        $regulasiList = [];
        if (Schema::hasTable('cms_regulasi')) {
            try {
                $regulasiList = DB::table('cms_regulasi')->orderBy('id', 'asc')->limit(15)->get(['judul', 'kategori', 'badge'])->toArray();
            } catch (\Throwable $e) {
            }
        }

        $lelangPortals = [];
        if (Schema::hasTable('cms_lelang_portals')) {
            try {
                $lelangPortals = DB::table('cms_lelang_portals')->orderBy('id', 'asc')->limit(12)->get(['nama_portal', 'deskripsi', 'url'])->toArray();
            } catch (\Throwable $e) {
            }
        }

        // 5. Memori Koreksi Permanen dari Admin (ai_memories)
        $this->ensureMemoryTable();
        $adminMemories = [];
        if (Schema::hasTable('ai_memories')) {
            try {
                $memRows = DB::table('ai_memories')->orderByDesc('id')->limit(30)->get();
                foreach ($memRows as $mRow) {
                    $adminMemories[] = [
                        'topik'   => $mRow->question_context ?: $mRow->trigger_keywords,
                        'koreksi' => $mRow->memory_note,
                        'keywords'=> array_filter(explode(',', (string) $mRow->trigger_keywords)),
                    ];
                }
            } catch (\Throwable $e) {
            }
        }

        return [
            'tanggal_hari_ini'      => date('d F Y'),
            'catatan_koreksi_admin' => $adminMemories,
            'panduan_layanan_web'   => [
                'pendaftaran_anggota' => 'Siapkan akta pendirian, NIB, dan NPWP badan usaha, lalu daftar melalui menu Login > Anggota INKINDO di panel kanan website untuk masuk ke Portal SIM-INKINDO.',
                'pendaftaran_mitra'   => 'Perusahaan dapat mengajukan kemitraan melalui menu Mitra Kerja > Daftar Mitra, lalu menunggu verifikasi Admin DPP INKINDO DKI Jakarta.',
                'klinik_konsultasi'   => 'Layanan konsultasi gratis untuk anggota (Advokasi & Mediasi, Regulasi, Perpajakan, Pelayanan SBU/KTA/OSS). Tersedia di menu Klinik Konsultasi setelah login.',
                'info_lelang'         => 'Pemantauan paket pengadaan jasa konsultansi pemerintah tersedia melalui menu Info Lelang (LKPP dan portal lelang lainnya).',
            ],
            'sekretariat'       => $contactInfo,
            'mitra_total'       => $mitraTotal,
            'mitra_list'        => $mitraList,
            'bulan_ditanyakan'  => $detectedMonthName,
            'berita_relevan'    => $monthMatchedBerita,
            'berita_terbaru'    => $beritaItems,
            'anggota_statistik'    => $memberStats,
            'kualifikasi_ditanya'  => $askedKualifikasi,
            'perusahaan_list'      => $companyList,
            'perusahaan_cocok'  => $matchedCompanies,
            'sbu_cocok'         => $matchedSbus,
            'proyek_cocok'      => $matchedProjects,
            'regulasi'          => $regulasiList,
            'info_lelang'       => $lelangPortals,
        ];
    }

    private function cleanPlainText(string $text): string
    {
        $cleaned = preg_replace('/^\s*\*\s+/m', '• ', $text) ?? $text;
        $cleaned = str_replace('*', '', $cleaned);
        return trim($cleaned);
    }

    private function callGemini(string $apiKey, string $model, string $message, array $history, array $contextData): ?string
    {
        $sekretariat = $contextData['sekretariat'];
        $contextJson = json_encode($contextData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $systemInstruction = "Kamu adalah Asisten Virtual resmi DPP INKINDO DKI Jakarta, dengan gaya komunikasi ramah, hangat, dan natural seperti manusia (ala Veronika Telkomsel).\n\n"
            . "ATURAN WAJIB:\n"
            . "1. UTAMAKAN `catatan_koreksi_admin` jika ada topik/koreksi dari Admin yang relevan dengan pertanyaan pengguna.\n"
            . "2. Jawab singkat, padat, dan langsung ke inti yang ditanyakan. Jika pengguna menanyakan 'Perusahaan apa / PT apa yang mempunyai SBU ...', cukup sebutkan nama perusahaannya saja (mis. PT DUTA CIPTA MANDIRI ENGINEERING CONSULTANT) tanpa merinci daftar SBU lain yang tidak ditanyakan. DILARANG menggunakan tanda bintang (* atau **) atau format Markdown.\n"
            . "3. Gunakan HANYA fakta dari DATA RESMI WEBSITE di bawah. DILARANG mengarang nama PT, jumlah anggota, SBU, proyek, atau jadwal yang tidak ada di data.\n"
            . "4. Jika pengguna menanyakan PT di wilayah tertentu (mis. Jakarta Selatan) dan di `perusahaan_list` / `perusahaan_cocok` ada yang cocok, sebutkan nama PT dan detail singkatnya; jika belum ada yang tercatat di wilayah tersebut, sampaikan dengan jujur PT apa saja yang saat ini sudah terdaftar di database.\n"
            . "5. Jika pertanyaan sama sekali di luar konteks website/INKINDO DKI Jakarta, arahkan pengguna menghubungi Kesekretariatan DPP INKINDO DKI Jakarta "
            . "(Telp: {$sekretariat['telepon_1']} / {$sekretariat['telepon_2']}, Email: {$sekretariat['email_1']}, Alamat: {$sekretariat['alamat']}, Jam Operasional: {$sekretariat['jam_operasional']}).\n\n"
            . "DATA RESMI WEBSITE:\n" . $contextJson;

        $contents = [];
        foreach (array_slice($history, -4) as $turn) {
            $tText = trim((string) ($turn['text'] ?? ''));
            $tRole = ($turn['role'] ?? 'user') === 'model' ? 'model' : 'user';
            if ($tText !== '') {
                $contents[] = [
                    'role'  => $tRole,
                    'parts' => [['text' => $tText]],
                ];
            }
        }
        $contents[] = [
            'role'  => 'user',
            'parts' => [['text' => $message]],
        ];

        $basePayload = [
            'systemInstruction' => [
                'parts' => [['text' => $systemInstruction]],
            ],
            'contents' => $contents,
            'generationConfig' => [
                'temperature'     => 0.25,
                'maxOutputTokens' => 1000,
            ],
        ];

        $modelsToTry = array_values(array_unique([
            $model,
            'gemini-2.5-flash-lite',
            'gemini-flash-lite-latest',
        ]));

        foreach ($modelsToTry as $tryModel) {
            $cacheKey = 'gemini_skip_' . md5($tryModel);
            if (Cache::has($cacheKey)) {
                continue;
            }

            $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/' . rawurlencode($tryModel) . ':generateContent?key=' . urlencode($apiKey);
            $response = $this->postGeminiRequest($endpoint, $basePayload);

            if ($response && $response->successful()) {
                $rawText = trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text', ''));
                if ($rawText !== '') {
                    return $this->cleanPlainText($rawText);
                }
            }

            if ($response) {
                $status = $response->status();
                Log::warning('Gemini API HTTP ' . $status . ' (' . $tryModel . '): ' . $response->body());
                if (in_array($status, [404, 429], true)) {
                    // Simpan status limit/404 selama 15 menit agar chat berikutnya langsung cepat tanpa menunggu request gagal
                    Cache::put($cacheKey, true, now()->addMinutes(15));
                    continue;
                }
                if (in_array($status, [401, 403], true)) {
                    break;
                }
            }
        }

        return null;
    }

    private function postGeminiRequest(string $endpoint, array $payload): ?\Illuminate\Http\Client\Response
    {
        try {
            $client = app()->environment('local') ? Http::withoutVerifying() : Http::withOptions([]);
            return $client->timeout(15)->post($endpoint, $payload);
        } catch (\Throwable $e) {
            Log::warning('Gemini API timeout/error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Mesin penjawab berbasis database yang memahami intent & konteks percakapan sebelumnya
     * ketika API AI sedang sibuk (HTTP 503) atau kuota harian habis (HTTP 429).
     */
    private function buildSmartDatabaseReply(string $message, array $keywords, array $contextData, array $history = []): string
    {
        $lower = mb_strtolower($message);
        $sek   = $contextData['sekretariat'];

        // 0. Cek Memori Koreksi Admin terlebih dahulu
        if (!empty($contextData['catatan_koreksi_admin']) && !empty($keywords)) {
            $bestMatch = null;
            $bestScore = 0;
            foreach ($contextData['catatan_koreksi_admin'] as $mem) {
                $memKws = $mem['keywords'] ?? [];
                $score = count(array_intersect($keywords, $memKws));
                if ($score > $bestScore && ($score >= 2 || (count($keywords) === 1 && $score === 1))) {
                    $bestScore = $score;
                    $bestMatch = $mem['koreksi'];
                }
            }
            if ($bestMatch !== null) {
                return $bestMatch;
            }
        }

        // 0b. Deteksi pertanyaan lanjutan ("apakah ada lagi selain itu?", "apa saja selain itu?", "sisanya?", "ada lagi?")
        $isFollowUpMore = (bool) preg_match('/\b(selain\s+itu|ada\s+lagi|sisanya|lainnya|yang\s+lain|semuanya|lebih\s+lengkap)\b/u', $lower);
        if ($isFollowUpMore && !empty($history)) {
            $lastBotText = '';
            for ($i = count($history) - 1; $i >= 0; $i--) {
                if (($history[$i]['role'] ?? '') === 'model' && !empty($history[$i]['text'])) {
                    $lastBotText = (string) $history[$i]['text'];
                    break;
                }
            }

            if ($lastBotText !== '') {
                $lastBotLower = mb_strtolower($lastBotText);
                if (str_contains($lastBotLower, 'mitra kerja')) {
                    $remainingMitra = [];
                    foreach ($contextData['mitra_list'] as $m) {
                        if (!str_contains($lastBotLower, mb_strtolower($m['nama']))) {
                            $remainingMitra[] = '• ' . $m['nama'];
                        }
                    }
                    if (!empty($remainingMitra)) {
                        return "Berikut Mitra Kerja aktif lainnya yang belum disebutkan di atas:\n" . implode("\n", $remainingMitra);
                    }
                    return "Tidak ada lagi, seluruh {$contextData['mitra_total']} Mitra Kerja aktif yang tercatat di database sudah disebutkan semuanya.";
                }

                if (str_contains($lastBotLower, 'perusahaan anggota') || str_contains($lastBotLower, 'memiliki sbu')) {
                    $remainingPt = [];
                    foreach ($contextData['perusahaan_list'] as $c) {
                        if (!str_contains($lastBotLower, mb_strtolower($c->nama_pt))) {
                            $remainingPt[] = "• {$c->nama_pt} (Kualifikasi: {$c->kualifikasi}, Wilayah: {$c->wilayah})";
                        }
                    }
                    if (!empty($remainingPt)) {
                        return "Berikut perusahaan anggota lainnya yang tercatat di database:\n" . implode("\n", $remainingPt);
                    }
                    return "Tidak ada lagi, seluruh perusahaan anggota yang sesuai di database sudah disebutkan di atas.";
                }
            }
        }

        // 1. Intent: Cara Pendaftaran / Menjadi Anggota atau Mitra Kerja (termasuk typo 'dafta' dan frasa 'cara menjadi' / 'syarat')
        $isAskingHowToRegister = (bool) preg_match('/\b(cara\s+dafta\w*|cara\s+mendaftar|mendaftar|pendaftaran|registrasi|gabung|bergabung|cara\s+menjadi|cara\s+jadi|menjadi\s+anggota|jadi\s+anggota|menjadi\s+mitra|jadi\s+mitra|syarat\s+menjadi|syarat\s+anggota|syarat\s+mitra|dafta\w*\s+menjadi|dafta\w*\s+anggota|dafta\w*\s+mitra)\b/u', $lower);
        if ($isAskingHowToRegister) {
            if (str_contains($lower, 'mitra')) {
                return "Untuk menjadi Mitra Kerja DPP INKINDO DKI Jakarta, silakan buka menu Mitra Kerja di panel sebelah kanan lalu klik Daftar Mitra (atau melalui halaman Ketentuan Mitra Kerja).\n\nAnda cukup membuat akun Mitra, melengkapi profil perusahaan, logo, serta katalog produk unggulan di Portal Mitra. Selanjutnya tim Admin DPP INKINDO DKI Jakarta akan memverifikasi dan menyetujui pengajuan kemitraan Anda.";
            }
            return "Untuk mendaftar menjadi Anggota DPP INKINDO DKI Jakarta, siapkan dokumen badan usaha seperti Akta Pendirian Perusahaan, NIB, dan NPWP.\n\nSelanjutnya klik menu Login > Anggota INKINDO di panel sebelah kanan untuk membuat akun dan melengkapi data perusahaan serta SBU di Portal SIM-INKINDO. Tim sekretariat akan memverifikasi pengajuan keanggotaan Anda.";
        }

        // 2. Intent: Jumlah / Statistik ("ada berapa", "jumlah", "total")
        $isAskingCount = (bool) preg_match('/\b(berapa|jumlah|total)\b/u', $lower);
        if ($isAskingCount) {
            if (str_contains($lower, 'mitra')) {
                $names = array_column($contextData['mitra_list'], 'nama');
                $listText = !empty($names) ? "\n\nDaftar Mitra Kerja aktif kami:\n• " . implode("\n• ", $names) : '';
                return "Saat ini terdapat {$contextData['mitra_total']} Mitra Kerja aktif yang bekerja sama dengan DPP INKINDO DKI Jakarta.{$listText}";
            }

            if (preg_match('/\b(pt|cv|perusahaan|anggota|konsultan|badan\s+usaha)\b/u', $lower)) {
                $st = $contextData['anggota_statistik'];
                $companies = $contextData['perusahaan_list'];
                if ($st['total'] === 0) {
                    return "Saat ini belum ada data perusahaan anggota yang tercatat di database. Untuk informasi keanggotaan lebih lanjut, silakan hubungi Sekretariat di {$sek['telepon_1']}.";
                }
                $names = [];
                foreach (array_slice($companies, 0, 15) as $c) {
                    $wil = !empty($c->wilayah) ? " ({$c->wilayah})" : '';
                    $names[] = "• {$c->nama_pt}{$wil} — Kualifikasi {$c->kualifikasi}";
                }
                $listStr = !empty($names) ? "\n\nPerusahaan yang terdaftar di database saat ini:\n" . implode("\n", $names) : '';
                return "Saat ini terdapat {$st['total']} perusahaan anggota yang terdaftar di database DPP INKINDO DKI Jakarta (Kualifikasi Besar: {$st['besar']}, Menengah: {$st['menengah']}, Kecil: {$st['kecil']}).{$listStr}";
            }
        }

        // 3. Intent: Pertanyaan seputar PT / Perusahaan / Anggota / Wilayah / SBU / Proyek
        $isCompanyOrSbuIntent = (bool) preg_match('/\b(pt|cv|perusahaan|anggota|konsultan|sbu|subklasifikasi|kbli|kualifikasi|proyek|pekerjaan|wilayah|daerah|jakarta\s+selatan|jakarta\s+pusat|jakarta\s+barat|jakarta\s+timur|jakarta\s+utara)\b/u', $lower);

        if ($isCompanyOrSbuIntent) {
            // Cek apakah menanyakan wilayah spesifik
            $regions = ['jakarta selatan', 'jakarta pusat', 'jakarta barat', 'jakarta timur', 'jakarta utara', 'kepulauan seribu'];
            foreach ($regions as $reg) {
                if (str_contains($lower, $reg)) {
                    $foundInRegion = [];
                    foreach ($contextData['perusahaan_list'] as $c) {
                        $hay = mb_strtolower(($c->wilayah ?? '') . ' ' . ($c->alamat_pt ?? ''));
                        if (str_contains($hay, $reg) || str_contains($hay, str_replace('jakarta ', '', $reg))) {
                            $foundInRegion[] = "• {$c->nama_pt} (KTA: {$c->no_kta}, Kualifikasi: {$c->kualifikasi}, Alamat: {$c->alamat_pt})";
                        }
                    }
                    $regTitle = ucwords($reg);
                    if (!empty($foundInRegion)) {
                        return "Berikut perusahaan anggota yang terdaftar di daerah {$regTitle}:\n" . implode("\n", $foundInRegion);
                    }
                    $allNames = array_map(fn ($c) => "{$c->nama_pt} ({$c->wilayah})", array_slice($contextData['perusahaan_list'], 0, 5));
                    $fallbackInfo = !empty($allNames) ? ' Perusahaan yang saat ini tercatat di database adalah: ' . implode(', ', $allNames) . '.' : '';
                    return "Saat ini belum ada perusahaan anggota di database yang tercatat di daerah {$regTitle}.{$fallbackInfo}";
                }
            }

            // Cek SBU spesifik jika ditanyakan SBU / subklasifikasi
            $askedKual = $contextData['kualifikasi_ditanya'] ?? null;
            if (str_contains($lower, 'sbu') || str_contains($lower, 'subklasifikasi') || str_contains($lower, 'kbli')) {
                if (empty($contextData['sbu_cocok'])) {
                    $kualInfo = $askedKual ? " dengan kualifikasi {$askedKual}" : '';
                    return "Saat ini belum ada perusahaan anggota di database yang tercatat memiliki SBU tersebut{$kualInfo}.";
                }

                $uniquePtNames = array_values(array_unique(array_map(fn ($s) => $s->nama_pt, $contextData['sbu_cocok'])));
                $kualLabel = $askedKual ? " (Kualifikasi {$askedKual})" : '';
                if (preg_match('/\b(perusahaan\s+apa|pt\s+apa|siapa\s+saja|pt\s+mana)\b/u', $lower)) {
                    if (count($uniquePtNames) === 1) {
                        return "Perusahaan anggota yang tercatat memiliki SBU tersebut{$kualLabel} adalah {$uniquePtNames[0]}.";
                    }
                    $ptLines = array_map(fn ($name) => "• {$name}", $uniquePtNames);
                    return "Perusahaan anggota yang tercatat memiliki SBU tersebut{$kualLabel} adalah:\n" . implode("\n", $ptLines);
                }

                $lines = [];
                foreach (array_slice($contextData['sbu_cocok'], 0, 5) as $s) {
                    $kode = $s->kode_kbli ? "{$s->kode_kbli} - " : '';
                    $kual = $s->kualifikasi ? " (Kualifikasi: {$s->kualifikasi})" : '';
                    $lines[] = "• {$s->nama_pt} — {$kode}{$s->judul_kbli}{$kual}";
                }
                return "Berikut perusahaan anggota yang tercatat memiliki SBU tersebut:\n" . implode("\n", $lines);
            }

            // Cek Proyek spesifik
            if (!empty($contextData['proyek_cocok']) && (str_contains($lower, 'proyek') || str_contains($lower, 'pekerjaan') || str_contains($lower, 'menangani'))) {
                $lines = [];
                foreach (array_slice($contextData['proyek_cocok'], 0, 5) as $p) {
                    $lines[] = "• {$p->nama_pt} — {$p->nama_pekerjaan}" . (!empty($p->tahun_proyek) ? " ({$p->tahun_proyek})" : '');
                }
                return "Berikut perusahaan anggota yang tercatat pernah menangani proyek tersebut:\n" . implode("\n", $lines);
            }

            // Cek Perusahaan yang cocok dengan kata kunci
            if (!empty($contextData['perusahaan_cocok'])) {
                $lines = [];
                foreach (array_slice($contextData['perusahaan_cocok'], 0, 6) as $c) {
                    $lines[] = "• {$c->nama_pt} (KTA: {$c->no_kta}, Kualifikasi: {$c->kualifikasi}, Wilayah: {$c->wilayah}, Alamat: {$c->alamat_pt})";
                }
                return "Berikut data perusahaan anggota yang ditemukan di database:\n" . implode("\n", $lines);
            }

            // Jika bertanya daftar PT secara umum
            if (!empty($contextData['perusahaan_list'])) {
                $lines = [];
                foreach (array_slice($contextData['perusahaan_list'], 0, 8) as $c) {
                    $lines[] = "• {$c->nama_pt} (Kualifikasi: {$c->kualifikasi}, Wilayah: {$c->wilayah})";
                }
                return "Berikut daftar perusahaan anggota yang tercatat di database DPP INKINDO DKI Jakarta:\n" . implode("\n", $lines);
            }
        }

        // 4. Intent: Kegiatan / Agenda / Berita / Publikasi
        $isBeritaIntent = (bool) preg_match('/\b(agenda|kegiatan|acara|berita|publikasi|rilis|majalah|emagazine|galeri|karya|bulan|januari|februari|maret|april|mei|juni|juli|agustus|september|oktober|november|desember)\b/u', $lower);
        if ($isBeritaIntent) {
            $askedMonth = $contextData['bulan_ditanyakan'] ?? null;
            if ($askedMonth !== null) {
                $monthLabel = ucfirst($askedMonth);
                if (!empty($contextData['berita_relevan'])) {
                    $lines = [];
                    foreach (array_slice($contextData['berita_relevan'], 0, 5) as $b) {
                        $lines[] = "• {$b['judul']} ({$b['tanggal']})";
                    }
                    return "Berikut agenda dan kegiatan pada bulan {$monthLabel}:\n" . implode("\n", $lines);
                }
                return "Saat ini belum ada jadwal kegiatan atau berita yang tercatat pada bulan {$monthLabel} di website kami.";
            }

            $sourceList = !empty($contextData['berita_relevan']) ? $contextData['berita_relevan'] : $contextData['berita_terbaru'];
            if (!empty($sourceList)) {
                $lines = [];
                foreach (array_slice($sourceList, 0, 5) as $b) {
                    $lines[] = "• {$b['judul']} ({$b['tanggal']})";
                }
                return "Berikut agenda dan informasi kegiatan terbaru yang tercatat di website kami:\n" . implode("\n", $lines);
            }
        }

        // 5. Intent: Klinik Konsultasi, Info Lelang, Mitra Kerja, Kontak Sekretariat
        if (str_contains($lower, 'klinik') || str_contains($lower, 'konsultasi')) {
            return "Layanan Klinik Konsultasi tersedia gratis bagi anggota DPP INKINDO DKI Jakarta, mencakup topik Advokasi & Mediasi, Regulasi, Perpajakan, serta Pelayanan (Perbankan, Notariat, Akuntan Publik, Asuransi, KTA, SBU, OSS).\n\nUntuk mengajukan jadwal sesi tatap muka maupun daring ({$sek['jam_operasional']}), silakan buka menu Klinik Konsultasi di panel sebelah kanan.";
        }

        if (str_contains($lower, 'lelang') || str_contains($lower, 'tender')) {
            return "Anda dapat memantau informasi paket pengadaan jasa konsultansi pemerintah melalui menu Info Lelang di panel sebelah kanan, termasuk tautan resmi ke LPSE / LKPP dan portal pengadaan lainnya.";
        }

        if (str_contains($lower, 'mitra')) {
            $names = array_column($contextData['mitra_list'], 'nama');
            $listText = !empty($names) ? "\n• " . implode("\n• ", $names) : '';
            return "Saat ini DPP INKINDO DKI Jakarta bermitra dengan {$contextData['mitra_total']} Mitra Kerja aktif:{$listText}";
        }

        if (preg_match('/\b(jam|buka|operasional|alamat|lokasi|kantor|kontak|telepon|telp|email|sekretariat|hubungi)\b/u', $lower)) {
            return "Anda dapat menghubungi Sekretariat DPP INKINDO DKI Jakarta melalui:\n• Alamat: {$sek['alamat']}\n• Telepon: {$sek['telepon_1']} / {$sek['telepon_2']}\n• Email: {$sek['email_1']}\n• Jam Operasional: {$sek['jam_operasional']}";
        }

        return "Maaf, informasi spesifik tersebut belum tersedia di data website kami. Untuk bantuan lebih lanjut, silakan hubungi Kesekretariatan DPP INKINDO DKI Jakarta di {$sek['telepon_1']} / {$sek['telepon_2']} atau email ke {$sek['email_1']} ({$sek['jam_operasional']}).";
    }
}
