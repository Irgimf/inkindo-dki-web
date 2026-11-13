<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CmsLelangController extends Controller
{
    /**
     * @return array<int, object>
     */
    private function defaultPortals(): array
    {
        return [
            (object) [
                'id'          => 1,
                'ikon'        => 'flight_takeoff',
                'kategori'    => 'BUMN Kebandarudaraan',
                'judul'       => 'Angkasa Pura',
                'deskripsi'   => 'Portal Procurement resmi untuk pengadaan jasa konsultansi fasilitas bandara, terminal, runway, arsitektur, dan rekayasa kebandarudaraan.',
                'teks_tombol' => 'Buka Portal Pengadaan',
                'url'         => 'https://procurement.angkasapura2.co.id/',
                'urutan'      => 1,
            ],
            (object) [
                'id'          => 2,
                'ikon'        => 'bolt',
                'kategori'    => 'BUMN Ketenagalistrikan',
                'judul'       => 'PT Perusahaan Listrik Negara (Persero)',
                'deskripsi'   => 'Sistem e-Procurement PT PLN (Persero) untuk paket studi kelayakan, jaringan transmisi, pembangkitan, dan transisi energi terbarukan.',
                'teks_tombol' => 'Buka e-Procurement PLN',
                'url'         => 'https://eproc.pln.co.id/',
                'urutan'      => 2,
            ],
            (object) [
                'id'          => 3,
                'ikon'        => 'train',
                'kategori'    => 'BUMN Transportasi Rel',
                'judul'       => 'PT Kereta Api Indonesia (Persero)',
                'deskripsi'   => 'Pengadaan barang dan jasa konsultansi prasarana perkeretaapian, modernisasi stasiun, persinyalan, dan integrasi logistik nasional.',
                'teks_tombol' => 'Buka e-Procurement KAI',
                'url'         => 'https://eproc.kai.id/',
                'urutan'      => 3,
            ],
            (object) [
                'id'          => 4,
                'ikon'        => 'account_balance',
                'kategori'    => 'Lembaga Multilateral',
                'judul'       => 'Asian Development Bank (ADB)',
                'deskripsi'   => 'Akses peluang tender dan paket jasa konsultansi internasional pada proyek pembiayaan infrastruktur berkelanjutan kawasan Asia-Pasifik.',
                'teks_tombol' => 'Buka Tender ADB',
                'url'         => 'https://www.adb.org/projects/tenders',
                'urutan'      => 4,
            ],
            (object) [
                'id'          => 5,
                'ikon'        => 'public',
                'kategori'    => 'Lembaga Finansial Global',
                'judul'       => 'World Bank (Bank Dunia)',
                'deskripsi'   => 'Direktori proyek dan operasional pembangunan Bank Dunia di Indonesia dan global, mencakup paket konsultansi teknis serta kebijakan publik.',
                'teks_tombol' => 'Buka Proyek World Bank',
                'url'         => 'https://projects.worldbank.org/en/projects-operations/projects-list',
                'urutan'      => 5,
            ],
            (object) [
                'id'          => 6,
                'ikon'        => 'shopping_cart_checkout',
                'kategori'    => 'Pemerintah RI (SPSE)',
                'judul'       => 'LKPP - LPSE Nasional',
                'deskripsi'   => 'Layanan Pengadaan Secara Elektronik Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah untuk seluruh K/L/D/I di Indonesia.',
                'teks_tombol' => 'Buka Portal LPSE LKPP',
                'url'         => 'https://lpse.lkpp.go.id/eproc4/lelang',
                'urutan'      => 6,
            ],
        ];
    }

    private function defaultPeluang(): object
    {
        return (object) [
            'hero_judul'        => 'Lelang Lainnya & Peluang Usaha',
            'hero_deskripsi'    => 'Kanal informasi paket pengadaan jasa konsultansi alternatif dari BUMN terkemuka, lembaga pembiayaan multilateral internasional, serta peluang kerjasama proyek khusus bagi seluruh anggota DPP INKINDO DKI Jakarta.',
            'section_badge'     => 'Pemberitahuan Resmi Sekretariat DPP',
            'section_judul'     => 'Peluang Usaha Lainnya',
            'section_deskripsi' => 'Informasi permohonan keahlian konsultan perencana struktur untuk mitigasi & pencegahan banjir bagi seluruh anggota.',
            'surat_label'       => 'Surat Pemberitahuan Terbuka',
            'surat_judul'       => 'Permintaan Konsultan Perencana Struktur untuk Pencegahan Banjir',
            'surat_status'      => 'Terbuka',
            'surat_kepada'      => 'Seluruh Anggota INKINDO DKI Jakarta',
            'surat_pengantar'   => 'Dapat kami sampaikan bahwa saat ini ada permintaan untuk konsultan Perencana Struktur untuk Pencegahan Banjir dengan kualifikasi sebagai berikut:',
            'kualifikasi'       => [
                'Mampu menganalisa data curah hujan secara mendalam, akurat, dan berbasis data hidrologi terkini.',
                'Mampu melakukan studi kelaikan pencegahan banjir terhadap struktur bangunan yang telah ada (existing structures).',
                'Melakukan perancangan pencegahan banjir di public area, sesuai dengan kaidah-kaidah yang berlaku: structural, arsitektural, estetika, dan lain-lain.',
                'Mampu berkoordinasi dengan kementrian teknis terkait (Kementrian PUPR, dan lain-lain), untuk mendapatkan izin terkait perancangan struktur bangunan pencegahan banjir.',
            ],
            'surat_penutup'     => 'Apabila Bidang Usaha Bapak/Ibu sesuai kualifikasi tersebut diatas dapat menghubungi / menyampaikan ke Sekretariat INKINDO DKI Jakarta.',
            'kontak_telp'       => '+62217942940(H) / +6282112079750',
            'kontak_email'      => 'sekretariat@inkindo-dki.org',
        ];
    }

    /**
     * @return array<int, object>
     */
    private function loadPortals(): array
    {
        try {
            if (Schema::hasTable('cms_lelang_portal')) {
                return DB::table('cms_lelang_portal')
                    ->orderBy('urutan')
                    ->orderBy('id')
                    ->get()
                    ->all();
            }
        } catch (\Throwable $e) {
            // Fallback ke data default jika DB belum siap
        }

        return $this->defaultPortals();
    }

    private function loadPeluang(): object
    {
        try {
            if (Schema::hasTable('cms_lelang_peluang')) {
                $row = DB::table('cms_lelang_peluang')->orderBy('id')->first();
                if ($row) {
                    $decoded = json_decode((string) ($row->kualifikasi_json ?? '[]'), true);
                    $row->kualifikasi = is_array($decoded) ? $decoded : [];
                    return $row;
                }
            }
        } catch (\Throwable $e) {
            // Fallback ke data default jika DB belum siap
        }

        return $this->defaultPeluang();
    }

    public function page(): View
    {
        return view('lelang-lainnya', [
            'portals' => $this->loadPortals(),
            'peluang' => $this->loadPeluang(),
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status'  => 'ok',
            'portals' => $this->loadPortals(),
            'peluang' => $this->loadPeluang(),
        ]);
    }
}

