<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Map Laravel SBU string to CodeIgniter kategori_sbu format.
     */
    private function mapSbuToCi4(string $sbu): string
    {
        $sbu = trim($sbu);
        if ($sbu === 'Jasa Konstruksi dan Non Jasa Konstruksi' || $sbu === 'NJK dan JK') {
            return 'NJK dan JK';
        }
        if ($sbu === 'Tidak Punya Keduanya' || $sbu === 'Tidak Punya NJK dan JK') {
            return 'Tidak Punya NJK dan JK';
        }
        if ($sbu === 'Non Jasa Konstruksi') {
            return 'Non Jasa Konstruksi';
        }
        return 'Jasa Konstruksi';
    }

    private function ensureJenisSbuColumn(): void
    {
        try {
            if (Schema::hasTable('sbu') && !Schema::hasColumn('sbu', 'jenis_sbu')) {
                DB::statement("ALTER TABLE `sbu` ADD COLUMN `jenis_sbu` VARCHAR(50) NULL DEFAULT NULL AFTER `company_id`");
            }
        } catch (\Throwable $e) {
            // Ignore if column already exists
        }
    }

    private function resolveJenisSbu(?string $jenisSbu, string $kodeKbli = '', string $companyKategori = 'Jasa Konstruksi'): string
    {
        $kat = trim($companyKategori);
        if ($kat === 'Non Jasa Konstruksi') {
            return 'Non Jasa Konstruksi';
        }
        if ($kat === 'Jasa Konstruksi') {
            return 'Jasa Konstruksi';
        }

        $jenis = trim((string) $jenisSbu);
        if ($jenis === 'Non Jasa Konstruksi' || strtoupper($jenis) === 'NJK') {
            return 'Non Jasa Konstruksi';
        }
        if ($jenis === 'Jasa Konstruksi' || strtoupper($jenis) === 'JK') {
            return 'Jasa Konstruksi';
        }

        $kode = strtoupper(trim($kodeKbli));
        if ($kode !== '' && (preg_match('/^[0-9]/', $kode) || str_starts_with($kode, 'NJK') || str_starts_with($kode, 'SC') || str_starts_with($kode, 'MS'))) {
            return 'Non Jasa Konstruksi';
        }
        return 'Jasa Konstruksi';
    }

    /**
     * Sync a Member record from ProjectWeb (Laravel) to `companies` and `sbu` tables in SistemManajemenDataPT (CI4).
     */
    private function syncMemberToCi4Tables(Member $member, ?string $oldNpa = null): void
    {
        if (!Schema::hasTable('companies')) {
            return;
        }
        $this->ensureJenisSbuColumn();

        $now = now()->format('Y-m-d H:i:s');
        $kategoriSbu = $this->mapSbuToCi4($member->sbu ?? 'Jasa Konstruksi');

        $existingCompany = DB::table('companies')
            ->where('member_id', $member->id)
            ->orWhere('no_kta', $member->npa)
            ->when($oldNpa, fn ($q) => $q->orWhere('no_kta', $oldNpa))
            ->first();

        $companyPayload = [
            'member_id'    => $member->id,
            'nama_pt'      => $member->name,
            'no_kta'       => $member->npa,
            'status'       => $member->status ?: 'Penuh',
            'kualifikasi'  => $member->kualifikasi ?: 'Menengah',
            'wilayah'      => $member->wilayah ?: 'Jakarta Selatan',
            'kategori_sbu' => $kategoriSbu,
            'alamat_pt'    => $member->alamat_domisili ?: '-',
            'alamat_surat' => $member->alamat_surat ?: ($member->alamat_domisili ?: '-'),
            'telepon'      => $member->telepon ?: '-',
            'fax'          => $member->fax ?: '-',
            'email'        => $member->email ?: '-',
            'website'      => $member->website ?: '-',
            'updated_at'   => $now,
        ];

        if ($existingCompany) {
            $companyId = (int) $existingCompany->id;
            DB::table('companies')->where('id', $companyId)->update($companyPayload);
        } else {
            $companyPayload['user_id'] = Auth::id() ?: 1;
            $companyPayload['nama_pjbu'] = '-';
            $companyPayload['created_at'] = $now;
            $companyId = (int) DB::table('companies')->insertGetId($companyPayload);
        }

        // Sync sbu_items JSON into `sbu` table
        if (!Schema::hasTable('sbu')) {
            return;
        }

        $sbuItems = is_array($member->sbu_items) ? $member->sbu_items : [];
        $desiredKblis = [];

        foreach ($sbuItems as $item) {
            $kelas = $item['kelas'] ?? ($member->kualifikasi ?? 'Menengah');
            $masaBerlaku = (!empty($item['masaBerlaku']) && $item['masaBerlaku'] !== '-') ? $item['masaBerlaku'] : null;
            $itemJenis = $item['jenis'] ?? null;
            $subbidangs = $item['subbidang'] ?? [];

            if (!empty($subbidangs) && is_array($subbidangs)) {
                foreach ($subbidangs as $sub) {
                    $parts = explode(' - ', $sub, 2);
                    $kode = trim($parts[0] ?? '');
                    $judul = trim($parts[1] ?? $sub);
                    if ($kode !== '') {
                        $desiredKblis[$kode] = [
                            'jenis_sbu'    => $this->resolveJenisSbu($itemJenis, $kode, $kategoriSbu),
                            'kode_kbli'    => $kode,
                            'judul_kbli'   => $judul,
                            'kualifikasi'  => $kelas,
                            'masa_berlaku' => $masaBerlaku,
                        ];
                    }
                }
            } elseif (!empty($item['code'])) {
                $parts = explode(' - ', $item['code'], 2);
                $kode = trim($parts[0] ?? '');
                $judul = trim($parts[1] ?? $item['code']);
                if ($kode !== '') {
                    $desiredKblis[$kode] = [
                        'jenis_sbu'    => $this->resolveJenisSbu($itemJenis, $kode, $kategoriSbu),
                        'kode_kbli'    => $kode,
                        'judul_kbli'   => $judul,
                        'kualifikasi'  => $kelas,
                        'masa_berlaku' => $masaBerlaku,
                    ];
                }
            }
        }

        $existingSbus = DB::table('sbu')->where('company_id', $companyId)->get();
        $existingByKode = [];
        foreach ($existingSbus as $sbuRow) {
            $existingByKode[$sbuRow->kode_kbli] = $sbuRow;
        }

        // Insert or update desired KBLIs
        foreach ($desiredKblis as $kode => $kbliData) {
            if (isset($existingByKode[$kode])) {
                DB::table('sbu')->where('id', $existingByKode[$kode]->id)->update([
                    'jenis_sbu'    => $kbliData['jenis_sbu'],
                    'judul_kbli'   => $kbliData['judul_kbli'],
                    'kualifikasi'  => $kbliData['kualifikasi'],
                    'masa_berlaku' => $kbliData['masa_berlaku'],
                    'updated_at'   => $now,
                ]);
            } else {
                DB::table('sbu')->insert([
                    'user_id'      => $existingCompany->user_id ?? (Auth::id() ?: 1),
                    'company_id'   => $companyId,
                    'jenis_sbu'    => $kbliData['jenis_sbu'],
                    'kode_kbli'    => $kbliData['kode_kbli'],
                    'judul_kbli'   => $kbliData['judul_kbli'],
                    'kualifikasi'  => $kbliData['kualifikasi'],
                    'masa_berlaku' => $kbliData['masa_berlaku'],
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ]);
            }
        }

        // Remove SBU rows that were removed in the modal
        foreach ($existingByKode as $kode => $sbuRow) {
            if (!isset($desiredKblis[$kode])) {
                if (Schema::hasTable('sbu_projects')) {
                    DB::table('sbu_projects')->where('sbu_id', $sbuRow->id)->delete();
                }
                DB::table('sbu')->where('id', $sbuRow->id)->delete();
            }
        }
    }

    /**
     * Return all members and summary statistics as JSON.
     */
    public function index()
    {
        $this->ensureJenisSbuColumn();

        $members = Member::orderBy('id', 'asc')->get();
        $total = $members->count();

        $besarCount = $members->where('kualifikasi', 'Besar')->count();
        $menengahCount = $members->where('kualifikasi', 'Menengah')->count();
        $kecilCount = $members->where('kualifikasi', 'Kecil')->count();

        $besarPct = $total > 0 ? round(($besarCount / $total) * 100) : 0;
        $menengahPct = $total > 0 ? round(($menengahCount / $total) * 100) : 0;
        $kecilPct = $total > 0 ? round(($kecilCount / $total) * 100) : 0;

        return response()->json([
            'success' => true,
            'is_admin' => Auth::check(),
            'stats' => [
                'total' => $total,
                'besar_count' => $besarCount,
                'menengah_count' => $menengahCount,
                'kecil_count' => $kecilCount,
                'besar_pct' => $besarPct,
                'menengah_pct' => $menengahPct,
                'kecil_pct' => $kecilPct,
            ],
            'members' => $members->map(function (Member $m) {
                $arr = $m->toFrontendArray();
                $arr['projects'] = [];
                $compKategori = $m->sbu ?? 'Jasa Konstruksi';

                // Always pull latest SBU rows & SBU Projects directly from SistemManajemenDataPT tables if available
                if (Schema::hasTable('companies') && Schema::hasTable('sbu')) {
                    $comp = DB::table('companies')
                        ->where('member_id', $m->id)
                        ->orWhere('no_kta', $m->npa)
                        ->first();
                    if ($comp) {
                        $compKategori = $comp->kategori_sbu ?: $compKategori;
                        $sbuRows = DB::table('sbu')->where('company_id', $comp->id)->orderBy('id', 'asc')->get();
                        $arr['sbuItems'] = $sbuRows->map(fn ($s) => [
                            'code' => trim(($s->kode_kbli ?? '') . ' - ' . ($s->judul_kbli ?? ''), ' -'),
                            'jenis' => $this->resolveJenisSbu($s->jenis_sbu ?? null, (string) ($s->kode_kbli ?? ''), (string) $compKategori),
                            'kelas' => $s->kualifikasi ?: ($m->kualifikasi ?: 'Menengah'),
                            'masaBerlaku' => !empty($s->masa_berlaku) ? date('d-m-Y', strtotime($s->masa_berlaku)) : '-',
                            'subbidang' => [],
                        ])->values()->all();

                        if (Schema::hasTable('sbu_projects')) {
                            $projectRows = DB::table('sbu_projects as p')
                                ->join('sbu as s', 'p.sbu_id', '=', 's.id')
                                ->where('s.company_id', $comp->id)
                                ->select('p.*', 's.kode_kbli', 's.judul_kbli', 's.jenis_sbu')
                                ->orderBy('p.id', 'asc')
                                ->get();

                            $arr['projects'] = $projectRows->map(function ($p) use ($compKategori) {
                                $rawNilai = preg_replace('/[^0-9]/', '', (string) ($p->nilai_proyek ?? ''));
                                $formattedNilai = $rawNilai !== ''
                                    ? 'Rp ' . number_format((float) $rawNilai, 0, ',', '.')
                                    : ($p->nilai_proyek ?: '-');

                                return [
                                    'id'             => $p->id,
                                    'kode_kbli'      => $p->kode_kbli ?? '-',
                                    'judul_kbli'     => $p->judul_kbli ?? '-',
                                    'jenis_sbu'      => $this->resolveJenisSbu($p->jenis_sbu ?? null, (string) ($p->kode_kbli ?? ''), (string) $compKategori),
                                    'nama_pekerjaan' => $p->nama_pekerjaan ?? '-',
                                    'nilai_proyek'   => $formattedNilai,
                                    'tahun_proyek'   => $p->tahun_proyek ?: '-',
                                    'lama_proyek'    => $p->lama_proyek ?: '-',
                                ];
                            })->values()->all();
                        }
                    }
                }

                if (!empty($arr['sbuItems']) && is_array($arr['sbuItems'])) {
                    $arr['sbuItems'] = array_map(function ($it) use ($compKategori) {
                        if (empty($it['jenis'])) {
                            $parts = explode(' - ', (string) ($it['code'] ?? ''), 2);
                            $it['jenis'] = $this->resolveJenisSbu(null, trim($parts[0] ?? ''), (string) $compKategori);
                        }
                        return $it;
                    }, $arr['sbuItems']);
                }

                return $arr;
            })->values(),
        ]);
    }

    /**
     * Store a newly created member in database.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npa' => ['required', 'string', 'max:100', 'unique:members,npa'],
            'status' => ['required', 'string', 'max:50'],
            'kualifikasi' => ['required', 'in:Besar,Menengah,Kecil'],
            'wilayah' => ['required', 'string', 'max:100'],
            'sbu' => ['required', 'string', 'max:150'],
            'alamat_domisili' => ['nullable', 'string'],
            'alamat_surat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:100'],
            'fax' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'string', 'max:150'],
            'website' => ['nullable', 'string', 'max:255'],
            'sbu_items' => ['nullable', 'array'],
            'sbu_items.*.code' => ['required_with:sbu_items', 'string', 'max:255'],
            'sbu_items.*.kelas' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.masaBerlaku' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.subbidang' => ['nullable', 'array'],
        ], [
            'name.required' => 'Nama perusahaan wajib diisi.',
            'npa.required' => 'Nomor Anggota (NPA) wajib diisi.',
            'npa.unique' => 'Nomor Anggota (NPA) tersebut sudah terdaftar.',
        ]);

        $member = Member::create($validated);
        $this->syncMemberToCi4Tables($member);

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil ditambahkan.',
            'member' => $member->toFrontendArray(),
        ], 201);
    }

    /**
     * Update the specified member in database.
     */
    public function update(Request $request, Member $member)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npa' => ['required', 'string', 'max:100', Rule::unique('members', 'npa')->ignore($member->id)],
            'status' => ['required', 'string', 'max:50'],
            'kualifikasi' => ['required', 'in:Besar,Menengah,Kecil'],
            'wilayah' => ['required', 'string', 'max:100'],
            'sbu' => ['required', 'string', 'max:150'],
            'alamat_domisili' => ['nullable', 'string'],
            'alamat_surat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:100'],
            'fax' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'string', 'max:150'],
            'website' => ['nullable', 'string', 'max:255'],
            'sbu_items' => ['nullable', 'array'],
            'sbu_items.*.code' => ['required_with:sbu_items', 'string', 'max:255'],
            'sbu_items.*.kelas' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.masaBerlaku' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.subbidang' => ['nullable', 'array'],
        ], [
            'name.required' => 'Nama perusahaan wajib diisi.',
            'npa.required' => 'Nomor Anggota (NPA) wajib diisi.',
            'npa.unique' => 'Nomor Anggota (NPA) tersebut sudah digunakan anggota lain.',
        ]);

        $oldNpa = $member->npa;
        $member->update($validated);
        $this->syncMemberToCi4Tables($member, $oldNpa);

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil diperbarui.',
            'member' => $member->toFrontendArray(),
        ]);
    }

    /**
     * Remove the specified member from database.
     */
    public function destroy(Member $member)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        if (Schema::hasTable('companies')) {
            $comp = DB::table('companies')
                ->where('member_id', $member->id)
                ->orWhere('no_kta', $member->npa)
                ->first();
            if ($comp) {
                if (Schema::hasTable('sbu')) {
                    $sbus = DB::table('sbu')->where('company_id', $comp->id)->get();
                    if (Schema::hasTable('sbu_projects')) {
                        foreach ($sbus as $s) {
                            DB::table('sbu_projects')->where('sbu_id', $s->id)->delete();
                        }
                    }
                    DB::table('sbu')->where('company_id', $comp->id)->delete();
                }
                DB::table('companies')->where('id', $comp->id)->delete();
            }
        }

        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil dihapus.',
        ]);
    }
}
