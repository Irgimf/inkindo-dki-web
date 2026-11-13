<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CmsKetentuanMitraController extends Controller
{
    private function defaultPage(): object
    {
        return (object) [
            'hero_judul'          => 'Tentang Mitra Kerja',
            'hero_paragraf_1'     => 'Halaman ini didedikasikan bagi para pihak yang bekerjasama dengan INKINDO DKI Jakarta baik untuk Kontraktor, Produsen, Suplier dan lain-lain.',
            'hero_paragraf_2'     => 'Apabila Bapak/Ibu berminat menjadi Mitra Kerja INKINDO DKI Jakarta dapat menghubungi Sekretariat INKINDO DKI Jakarta.',
            'tujuan_label'        => 'Kolaborasi & Sinergi Strategis',
            'tujuan_judul'        => 'Maksud & Tujuan Mitra Kerja',
            'tujuan_deskripsi'    => 'Dengan halaman mitra kerja ini diharapkan dapat memberikan manfaat khususnya bagi Anggota, para Mitra Kerja dan Masyarakat pada umumnya, baik dalam mencari barang/jasa maupun informasi yang dibutuhkan untuk kegiatan usaha terkait usaha jasa konsultansi.',
            'tujuan_cards'        => [
                (object) [
                    'judul'     => 'Bagi Anggota INKINDO',
                    'deskripsi' => 'Mempermudah 900+ badan usaha konsultan dalam mengakses referensi material bersertifikasi, teknologi terkini, penawaran harga korporat terbaik, serta vendor pelaksana yang terpercaya.',
                    'poin'      => [
                        'Akses langsung ke katalog produk & spesifikasi teknis',
                        'Dukungan transfer keahlian & workshop material',
                        'Jaminan mutu pengadaan dalam rancang bangun',
                    ],
                ],
                (object) [
                    'judul'     => 'Bagi Para Mitra Kerja',
                    'deskripsi' => 'Membuka jembatan interaksi promosi langsung dengan para perencana, perancang, pengawas, dan konsultan manajemen proyek di seluruh DKI Jakarta dan proyek nasional.',
                    'poin'      => [
                        'Publikasi resmi di portal direktori INKINDO DKI',
                        'Peluang business matching & sponsorship event',
                        'Sinergi penawaran pada proyek pemerintah & swasta',
                    ],
                ],
                (object) [
                    'judul'     => 'Bagi Masyarakat Luas',
                    'deskripsi' => 'Mendorong terwujudnya hasil karya pembangunan infrastruktur dan gedung yang lebih kokoh, aman, ramah lingkungan, serta memenuhi standar kepatuhan nasional.',
                    'poin'      => [
                        'Standar konstruksi yang transparan dan akuntabel',
                        'Penerapan material ramah lingkungan (Green Building)',
                        'Hasil investasi proyek yang berdaya tahan lama',
                    ],
                ],
            ],
            'syarat_label'        => 'Kriteria & Legalitas',
            'syarat_judul'        => 'Syarat Mitra Kerja',
            'syarat_deskripsi'    => 'Program kemitraan ini terbuka bagi seluruh pelaku usaha yang berkomitmen menjalin kerjasama secara profesional, transparan, dan berintegritas tinggi bersama DPP INKINDO DKI Jakarta.',
            'syarat_info_judul'   => 'Siapa yang Dapat Bermitra?',
            'syarat_info_isi'     => 'Kontraktor Pelaksana, Produsen Material Bahan Bangunan, Suplier Peralatan & Mesin, Penyedia Solusi Software/IT Desain (BIM, CAD), Perbankan, Penjaminan/Asuransi Proyek, dan Laboratorium Pengujian Teknis.',
            'ketentuan_label'     => 'Tata Tertib & Regulasi Kerjasama',
            'ketentuan_judul'     => 'Ketentuan Mitra Kerja',
            'ketentuan_deskripsi' => 'Seluruh hubungan kemitraan diatur secara profesional untuk melindungi reputasi asosiasi serta menjamin keterbukaan hak dan kewajiban kedua belah pihak.',
        ];
    }

    /**
     * @return array<int, object>
     */
    private function defaultSyarat(): array
    {
        return [
            (object) ['judul' => 'Badan Usaha Resmi', 'deskripsi' => 'Perusahaan berbadan hukum sah di Indonesia (PT, CV, Koperasi, Distributor Resmi / Agen Tunggal) dengan domisili usaha yang jelas.'],
            (object) ['judul' => 'Legalitas & Izin Usaha', 'deskripsi' => 'Memiliki Nomor Induk Berusaha (NIB) berbasis risiko aktif, Nomor Pokok Wajib Pajak (NPWP) Badan, serta izin operasional sektor terkait.'],
            (object) ['judul' => 'Bidang Usaha yang Relevan', 'deskripsi' => 'Bergerak di bidang yang menunjang aktivitas jasa konstruksi, jasa konsultansi keteknikan, dan layanan penunjang profesional lainnya.'],
            (object) ['judul' => 'Penunjukan PIC Resmi', 'deskripsi' => 'Menunjuk Person in Charge (PIC) tetap sebagai narahubung resmi dan berwenang melakukan koordinasi teknis dengan INKINDO DKI Jakarta.'],
            (object) ['judul' => 'Komitmen Mutu & SMAP', 'deskripsi' => 'Menyediakan produk/jasa berstandar SNI/internasional dan berkomitmen mematuhi Sistem Manajemen Anti Penyuapan (ISO 37001).'],
            (object) ['judul' => 'Registrasi Administratif', 'deskripsi' => 'Mengisi formulir pendaftaran kemitraan secara daring dan menandatangani kesepahaman kemitraan bersama sekretariat.'],
        ];
    }

    /**
     * @return array<int, object>
     */
    private function defaultKetentuan(): array
    {
        return [
            (object) ['ikon' => 'balance', 'judul' => '1. Prinsip & Asas Kemitraan', 'deskripsi' => 'Hubungan kemitraan bersifat non-eksklusif dan berorientasi pada sinergi saling menguntungkan (mutual benefit). Kemitraan tidak membatasi independensi para konsultan anggota INKINDO dalam menentukan keputusan teknis.'],
            (object) ['ikon' => 'campaign', 'judul' => '2. Hak & Fasilitas Mitra', 'deskripsi' => 'Mitra resmi berhak mencantumkan logo di direktori website INKINDO DKI, mengikuti agenda knowledge sharing / seminar teknis, serta berpeluang mempresentasikan inovasi produk dalam temu anggota asosiasi.'],
            (object) ['ikon' => 'assignment_turned_in', 'judul' => '3. Kewajiban & Akuntabilitas', 'deskripsi' => 'Mitra berkewajiban memberikan informasi spesifikasi material/jasa yang akurat, menjamin ketersediaan barang/layanan purnajual, serta menjaga harga yang kompetitif bagi para konsultan anggota.'],
            (object) ['ikon' => 'calendar_clock', 'judul' => '4. Masa Berlaku & Evaluasi', 'deskripsi' => 'Status kemitraan berlaku selama 1 (satu) tahun kalender sejak tanggal pengesahan registrasi. DPP INKINDO DKI Jakarta melaksanakan evaluasi berkala untuk perpanjangan masa kemitraan berikutnya.'],
            (object) ['ikon' => 'security', 'judul' => '5. Integritas & Etika Bisnis', 'deskripsi' => 'Mitra wajib menjunjung tinggi etika bisnis yang sehat, tidak melakukan praktik monopoli, gratifikasi ilegal, atau penyuapan yang bertentangan dengan standar SMAP ISO 37001 dan hukum Republik Indonesia.'],
            (object) ['ikon' => 'cancel', 'judul' => '6. Pengakhiran Kemitraan', 'deskripsi' => 'DPP INKINDO DKI Jakarta berhak menghentikan kemitraan secara sepihak apabila mitra terbukti melakukan pelanggaran hukum, wanprestasi kontrak, atau merugikan harkat dan martabat asosiasi.'],
        ];
    }

    private function loadData(): array
    {
        $page           = $this->defaultPage();
        $syaratItems    = $this->defaultSyarat();
        $ketentuanItems = $this->defaultKetentuan();

        try {
            if (Schema::hasTable('cms_mitra_ketentuan_page')) {
                $row = DB::table('cms_mitra_ketentuan_page')->orderBy('id')->first();
                if ($row) {
                    $decoded = json_decode((string) ($row->tujuan_cards_json ?? '[]'), true);
                    $row->tujuan_cards = [];
                    if (is_array($decoded)) {
                        foreach ($decoded as $c) {
                            $row->tujuan_cards[] = (object) [
                                'judul'     => $c['judul'] ?? '',
                                'deskripsi' => $c['deskripsi'] ?? '',
                                'poin'      => is_array($c['poin'] ?? null) ? $c['poin'] : [],
                            ];
                        }
                    }
                    $page = $row;
                }
            }

            if (Schema::hasTable('cms_mitra_ketentuan_items')) {
                $syaratItems = DB::table('cms_mitra_ketentuan_items')
                    ->where('jenis', 'syarat')
                    ->orderBy('urutan')
                    ->orderBy('id')
                    ->get()
                    ->all();

                $ketentuanItems = DB::table('cms_mitra_ketentuan_items')
                    ->where('jenis', 'ketentuan')
                    ->orderBy('urutan')
                    ->orderBy('id')
                    ->get()
                    ->all();
            }
        } catch (\Throwable $e) {
            // Fallback ke data default jika koneksi DB belum siap
        }

        return [
            'page'           => $page,
            'syaratItems'    => $syaratItems,
            'ketentuanItems' => $ketentuanItems,
        ];
    }

    public function page(): View
    {
        return view('ketentuan-mitra-kerja', $this->loadData());
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data'   => $this->loadData(),
        ]);
    }
}

