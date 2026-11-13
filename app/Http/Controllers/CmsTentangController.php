<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CmsTentangController extends Controller
{
    private function defaultProfile(): array
    {
        return [
            'hero_title'       => 'Tentang Kami',
            'hero_subtitle'    => 'Mengenal lebih dekat profil organisasi, sejarah panjang, visi & misi, kode etik kehormatan profesi, serta struktur kepengurusan DPP INKINDO DKI Jakarta.',
            'hero_image'       => 'assets/jakarta3.webp',
            'sejarah_heading'  => 'Sejarah INKINDO DKI Jakarta',
            'sejarah_content'  => implode("\n\n", [
                'INKINDO (Ikatan Nasional Konsultan Indonesia) merupakan asosiasi perusahaan konsultan independen yang didirikan pada tanggal 29 Juni 1979, sebagai hasil fusi antara IKINDO (Ikatan Konsultan Indonesia) dan PKTPI (Persatuan Konsultan Teknik Pembangunan Indonesia). Anggota INKINDO tersebar di 33 provinsi di seluruh Indonesia dan total memiliki anggota 7000 perusahaan konsultan.',
                'INKINDO DKI Jakarta terletak di Provinsi Daerah Khusus Ibukota Jakarta, sekarang memiliki anggota aktif 900 perusahaan, merupakan INKINDO provinsi terbesar diantara 33 provinsi di Indonesia. Anggota INKINDO DKI Jakarta dikelompokan dalam 3 (tiga) kualifikasi : Besar (20%), Menengah (45%), dan Kecil (35%). Beberapa anggota INKINDO DKI Jakarta telah menangani banyak proyek-proyek terkemuka, di Indonesia dan di manca negara.',
            ]),
            'sejarah_image'    => 'assets/hero-bg.webp',
            'visimisi_heading' => 'Visi & Misi',
            'visimisi_bg_image'=> 'assets/jakarta3.webp',
            'visi_title'       => 'Visi',
            'visi_text'        => 'Gerak Cepat Memajukan Anggota yang Berkelanjutan.',
            'misi_title'       => 'Misi',
            'misi_items'       => [
                'Meningkatkan pelayanan yang proaktif, cepat, mudah, dan terjangkau.',
                'Memperkuat kapasitas dan kolaborasi antara Anggota (pelatihan, akses informasi dan permodalan, SDM).',
                'Memperkuat peran sebagai mitra strategis pemerintah, swasta dan sinergi dengan DPN INKINDO, DPP provinsi lain, mitra kerja, serta asosiasi.',
                'Membina Anggota dalam menghadapi dinamika regulasi.',
                'Menjadikan INKINDO DKI sebagai organisasi yang inovatif, adaptif, transparan dan akuntabel.',
            ],
            'kode_etik_heading'  => 'Kode Etik',
            'kode_etik_subtitle' => 'Dengan menjunjung tinggi Etika Ikatan Nasional Konsultan Indonesia sebagai dasar yang dinamis untuk melayani sesama manusia, maka tiap Anggota Ikatan Nasional Konsultan Indonesia wajib untuk:',
            'kode_etik_items'    => [
                'Menjunjung tinggi kehormatan, kemuliaan, dan nama baik profesi konsultan dalam hubungan kerja dengan pemberi tugas sesama rekan konsultan dan masyarakat.',
                'Bertindak jujur, tidak memihak, serta penuh dedikasi melayani pemberi tugas dan masyarakat.',
                'Tukar menukar pengetahuan bidang keahlian secara wajar dengan rekan konsultan dan kelompok profesi serta meningkatkan pengetahuan masyarakat terhadap profesi konsultan sehingga dapat lebih menghayati karya konsultan.',
                'Menghormati prinsip pemberian imbalan jasa yang layak dan memadai bagi konsultan, sehingga dapat dipertanggungjawabkan secara profesional dan moral yang menjamin dapat dilaksanakannya tugas yang dipercayakan memenuhi semua persyaratan yang terkait dengan keahlian, kompetensi, dan integritas tinggi.',
                'Menghargai dan menghormati reputasi profesional rekan konsultan dan setiap perjanjian kerja yang berhubungan dengan profesinya.',
                'Mendapatkan tugas terutama berdasarkan standar keahlian profesional tanpa melalui cara-cara persaingan yang tidak sehat.',
                'Bekerjasama sebagai konsultan hanya dengan rekan konsultan atau tenaga ahli lain yang memiliki integritas tinggi.',
                'Menjalankan asas pembangunan berkelanjutan dalam semua aspek pelayanan jasa konsultan sebagai bagian integral dari tanggungjawabnya terhadap sesama, lingkungan kehidupan yang luas, dan generasi yang akan datang.',
            ],
        ];
    }

    private function defaultUnits(): array
    {
        return [
            ['slug' => 'dpph', 'nama' => 'DPPH', 'deskripsi' => 'Dewan Pengurus Provinsi Harian DPP INKINDO DKI Jakarta', 'intro_text' => null, 'icon' => 'account_balance', 'urutan' => 1],
            ['slug' => 'dppl', 'nama' => 'DPPL', 'deskripsi' => 'Dewan Pengurus Provinsi Lengkap DPP INKINDO DKI Jakarta', 'intro_text' => null, 'icon' => 'account_tree', 'urutan' => 2],
            ['slug' => 'badan', 'nama' => 'Badan - Badan', 'deskripsi' => 'Struktur Badan-Badan Kerja DPP INKINDO DKI Jakarta', 'intro_text' => null, 'icon' => 'corporate_fare', 'urutan' => 3],
            ['slug' => 'komite', 'nama' => 'Komite', 'deskripsi' => 'Komite-Komite Kerja Strategis DPP INKINDO DKI Jakarta', 'intro_text' => null, 'icon' => 'groups_3', 'urutan' => 4],
            ['slug' => 'dkp', 'nama' => 'DKP', 'deskripsi' => 'Dewan Kehormatan Provinsi DPP INKINDO DKI Jakarta', 'intro_text' => 'Dewan Kehormatan Provinsi (DKP) bertugas menjaga keluhuran martabat, mengawasi penerapan Kode Etik dan Anggaran Dasar/Anggaran Rumah Tangga (AD/ART), serta memberikan putusan mediasi terhadap persoalan etika profesi antar-anggota.', 'icon' => 'gavel', 'urutan' => 5],
            ['slug' => 'dpop', 'nama' => 'DPOP', 'deskripsi' => 'Dewan Pertimbangan Organisasi Provinsi DPP INKINDO DKI Jakarta', 'intro_text' => 'Dewan Pertimbangan Organisasi Provinsi (DPOP) beranggotakan para tokoh senior dan pimpinan purnatugas yang bertugas memberikan saran, nasihat, dan pertimbangan strategis kepada Dewan Pengurus Provinsi demi kesinambungan visi asosiasi.', 'icon' => 'manage_accounts', 'urutan' => 6],
            ['slug' => 'setprov', 'nama' => 'Setprov', 'deskripsi' => 'Sekretariat Pelayanan Eksekutif DPP INKINDO DKI Jakarta', 'intro_text' => null, 'icon' => 'admin_panel_settings', 'urutan' => 7],
        ];
    }

    private function defaultOrganizationGroups(): array
    {
        $bidangRows = [
            ['1) Pranata Usaha', 'Ir. M. Saifullah, S.T., M.M., IPM.', 'M. Aufa Ibadur Rahman, S.E., PMP'],
            ['2) Pelayanan & Pemberdayaan Anggota', 'Pensong Benny, S.E., M.Si', 'Toni Haryanto, S.T.'],
            ['3) Penguatan Organisasi', 'Fakhrudin, M.Si, Psikolog', 'Hendri Prasetyo, S.IP'],
            ['4) Pengembangan Jasa Konstruksi', 'Ir. Mangiring Purba', 'Yanwar Anang Prabowo'],
            ['5) Pengembangan Non Jasa Konstruksi', 'Ir. Chandra Rambey, M.Sc', 'Diana Harmaini Syafei, S.T'],
            ['6) Perencanaan Strategis & Monitoring', 'Ir. Rachmadi', 'Taufan Setia Nusantara, S.E.'],
            ['7) Kerjasama Antar Lembaga', 'Ir. Agus Sudjatmiko', 'Ir. Irza Ratnasari'],
            ['8) Hukum & Perlindungan Anggota', 'Dewisari, M.M', 'Dr. Ery Sunandar, S.Si., M.Si., SH'],
            ['9) Peluang Pasar Internasional', 'Mohamad Imam Machfudin, S.T.', 'Herdiansa Putra, S.P.'],
            ['10) Digitalisasi & Humas', 'Munif Sofian, S.Kom', 'Aditya Tubagus Maulana, S.T.'],
            ['11) ESG & Keberlanjutan', 'Dr. Zefri, M.Si', 'Achmad Chairul Wafa, S.I.Kom'],
            ['12) Pasar Swasta & BUMN', 'Ir. Setyo Triyono, IPM., ACPE.', 'Ar. Doti Windajani, M.T., IAI.'],
        ];

        $groups = [
            'dpph' => [
                [
                    'id' => 1, 'nama_kelompok' => 'Pimpinan Harian', 'kode_badge' => null, 'tipe_tampilan' => 'leader', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua DPP INKINDO DKI Jakarta', 'nama' => 'Afsdyah Eky Vitalina, SP., M.Si.', 'keterangan_badge' => 'Pimpinan Harian', 'is_highlight' => 1],
                    ],
                ],
                [
                    'id' => 2, 'nama_kelompok' => 'Kesekretariatan & Kebendaharaan', 'kode_badge' => '1', 'tipe_tampilan' => 'officers', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Sekretaris', 'nama' => 'Aditya Prakarsa Yasin, BSc, M.M', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Sekretaris', 'nama' => 'Jufriady Tanjung, S.T., M.T', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Bendahara', 'nama' => 'Tri Murdiatmoko, S.E.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Bendahara', 'nama' => 'Andina Larasati, S.Hum., M.M.', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
            ],
            'badan' => [
                [
                    'id' => 101, 'nama_kelompok' => 'Badan Sertifikasi Anggota Provinsi (BSAP)', 'kode_badge' => 'I', 'tipe_tampilan' => 'badan', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Ir. Mangiring Purba', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Munif Sofian, S.Kom', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Bendahara', 'nama' => 'Andina Larasati, S.Hum., M.M.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Baharun Nazir, S.E.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Rizky Agung, S.E', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
                [
                    'id' => 102, 'nama_kelompok' => 'Badan Advokasi dan Mediasi Anggota (BAMA)', 'kode_badge' => 'II', 'tipe_tampilan' => 'badan', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Dr. Ery Sunandar, S.Si., M.Si., S.H., M.H.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Ketua', 'nama' => 'Denok Wahyuni, S.H.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Ismail Yusuf, S.E., M.M.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Warwo, S.T | Abel Kautsar', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Achmad Fahrur Rozi, S.Sos | Ir. Reinhart T.P.S', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
                [
                    'id' => 103, 'nama_kelompok' => 'Badan Riset dan Bakti Profesi (BRBP)', 'kode_badge' => 'III', 'tipe_tampilan' => 'badan', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Ir. Halomoan Tambun', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Ketua', 'nama' => 'Achmad Henrawan, S.T.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Bayu Sulistianto, S.I. | Fahriza, S.P., M.P.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Budhianto | Ishari Thaib, S.E.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'DR. Ing. Ir. I Gede Oka Sindhu Pribadi, M.Sc', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
                [
                    'id' => 104, 'nama_kelompok' => 'Badan Pengembangan Kapasitas Anggota (BPKA)', 'kode_badge' => 'IV', 'tipe_tampilan' => 'badan', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Derry P Sitorus, AT., S.E.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Ketua', 'nama' => 'Siti Aisyah TW, S.E., M.M', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Ir. Zaenal Mustofa Djawahir', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Syaripin | Harsyaf Nurman D., S.T.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Steven Valerian B. | Gerrits S.B.C. Udjung', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
                [
                    'id' => 105, 'nama_kelompok' => 'Badan Pengkajian Kebijakan & Regulasi', 'kode_badge' => 'V', 'tipe_tampilan' => 'badan', 'section_label' => null, 'is_full_width' => 1,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Islana Jati Waluya, S.E., M.I.Kom', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Wakil Ketua', 'nama' => 'Ir. Ratna Ningrum, M.B.A', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Fahmi Anshari', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Rahyono, S.Kom | Satrio Rama W., M.Sc.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Rimong Rukmiarta, MT. | Ir. Lila Andari', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Tati Lanniari Pulungan | Adung Kurnaen', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
            ],
            'dkp' => [
                [
                    'id' => 201, 'nama_kelompok' => 'Daftar Pengurus DKP', 'kode_badge' => null, 'tipe_tampilan' => 'officers', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua merangkap Anggota', 'nama' => 'Ir. Bambang Soendaroe, M.T.', 'keterangan_badge' => null, 'is_highlight' => 1],
                        ['jabatan' => 'Wakil Ketua merangkap Anggota', 'nama' => 'Ir. Mukhsin Moechtar, IPU., ACPE.', 'keterangan_badge' => null, 'is_highlight' => 1],
                        ['jabatan' => 'Sekretaris merangkap Anggota', 'nama' => 'Ir. Novia Damayanti, M.B.A.', 'keterangan_badge' => null, 'is_highlight' => 1],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Istanto Oerip, IPU.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Jumadi S. Witopawiro, M.S.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Stefanus Hindarko', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Dr. Ir. John P. Pantouw, M.S.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Jasman, S.T., M.T.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Yulianto', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Siti Rochamayanti, M.M.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Yudi Setiabudi', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
            ],
            'dpop' => [
                [
                    'id' => 301, 'nama_kelompok' => 'Daftar Pengurus DPOP', 'kode_badge' => null, 'tipe_tampilan' => 'officers', 'section_label' => null, 'is_full_width' => 0,
                    'members' => [
                        ['jabatan' => 'Ketua', 'nama' => 'Imam Hartawan, S.T., M.T.', 'keterangan_badge' => null, 'is_highlight' => 1],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Ir. Anton Gerbono', 'keterangan_badge' => null, 'is_highlight' => 1],
                        ['jabatan' => 'Anggota', 'nama' => 'Drs. Arry Budiyanto, M.Dev.Plg', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Suwendi, M.Sc.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Ir. Endang Nurzaman', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Jusarwanto, S.E., Ak.', 'keterangan_badge' => null, 'is_highlight' => 0],
                        ['jabatan' => 'Anggota', 'nama' => 'Dr. Ir. Lamidi, MTP, M.M.', 'keterangan_badge' => null, 'is_highlight' => 0],
                    ],
                ],
            ],
        ];

        foreach ($bidangRows as $idx => $b) {
            $groups['dpph'][] = [
                'id' => 10 + $idx, 'nama_kelompok' => $b[0], 'kode_badge' => '2', 'tipe_tampilan' => 'bidang', 'section_label' => 'Bidang Kerja DPPH', 'is_full_width' => 0,
                'members' => [
                    ['jabatan' => 'Wakil Ketua', 'nama' => $b[1], 'keterangan_badge' => null, 'is_highlight' => 0],
                    ['jabatan' => 'Wakil Sekretaris', 'nama' => $b[2], 'keterangan_badge' => null, 'is_highlight' => 0],
                ],
            ];
        }

        return $groups;
    }

    private function getTentangData(): array
    {
        $profile = $this->defaultProfile();

        try {
            if (Schema::hasTable('cms_tentang_profile')) {
                $row = DB::table('cms_tentang_profile')->orderBy('id')->first();
                if ($row) {
                    $misi = json_decode((string) ($row->misi_items_json ?? '[]'), true);
                    $kodeEtik = json_decode((string) ($row->kode_etik_items_json ?? '[]'), true);
                    $profile = [
                        'hero_title'        => (string) ($row->hero_title ?: $profile['hero_title']),
                        'hero_subtitle'     => (string) ($row->hero_subtitle ?? ''),
                        'hero_image'        => (string) ($row->hero_image ?: $profile['hero_image']),
                        'sejarah_heading'   => (string) ($row->sejarah_heading ?: $profile['sejarah_heading']),
                        'sejarah_content'   => (string) ($row->sejarah_content ?? ''),
                        'sejarah_image'     => (string) ($row->sejarah_image ?: $profile['sejarah_image']),
                        'visimisi_heading'  => (string) ($row->visimisi_heading ?: $profile['visimisi_heading']),
                        'visimisi_bg_image' => (string) ($row->visimisi_bg_image ?: $profile['visimisi_bg_image']),
                        'visi_title'        => (string) ($row->visi_title ?: 'Visi'),
                        'visi_text'         => (string) ($row->visi_text ?? ''),
                        'misi_title'        => (string) ($row->misi_title ?: 'Misi'),
                        'misi_items'        => is_array($misi) ? array_values(array_filter(array_map('strval', $misi), fn ($v) => trim($v) !== '')) : $profile['misi_items'],
                        'kode_etik_heading' => (string) ($row->kode_etik_heading ?: $profile['kode_etik_heading']),
                        'kode_etik_subtitle'=> (string) ($row->kode_etik_subtitle ?? ''),
                        'kode_etik_items'   => is_array($kodeEtik) ? array_values(array_filter(array_map('strval', $kodeEtik), fn ($v) => trim($v) !== '')) : $profile['kode_etik_items'],
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Fallback cleanly to defaults
        }

        $sejarahParagraphs = preg_split('/\r?\n\s*\r?\n/', trim((string) $profile['sejarah_content'])) ?: [];
        $profile['sejarah_paragraphs'] = array_values(array_filter(array_map('trim', $sejarahParagraphs), fn ($p) => $p !== ''));

        $units = $this->defaultUnits();
        $groupsByUnit = $this->defaultOrganizationGroups();

        try {
            if (Schema::hasTable('cms_org_units') && Schema::hasTable('cms_org_groups') && Schema::hasTable('cms_org_members')) {
                $dbUnits = DB::table('cms_org_units')->orderBy('urutan')->orderBy('id')->get();
                if ($dbUnits->count() > 0) {
                    $units = [];
                    $groupsByUnit = [];
                    $dbGroups = DB::table('cms_org_groups')
                        ->where('is_active', 1)
                        ->orderBy('urutan')
                        ->orderBy('id')
                        ->get();
                    $dbMembers = DB::table('cms_org_members')
                        ->where('is_active', 1)
                        ->orderBy('urutan')
                        ->orderBy('id')
                        ->get();

                    $membersByGroup = [];
                    foreach ($dbMembers as $m) {
                        $gid = (int) ($m->group_id ?? 0);
                        $membersByGroup[$gid][] = [
                            'id'               => (int) $m->id,
                            'jabatan'          => (string) ($m->jabatan ?? ''),
                            'nama'             => (string) ($m->nama ?? ''),
                            'keterangan_badge' => $m->keterangan_badge ? (string) $m->keterangan_badge : null,
                            'is_highlight'     => (int) ($m->is_highlight ?? 0),
                        ];
                    }

                    foreach ($dbGroups as $g) {
                        $gid = (int) $g->id;
                        $grpMembers = $membersByGroup[$gid] ?? [];
                        if (empty($grpMembers)) {
                            continue;
                        }
                        $groupsByUnit[(string) $g->unit_slug][] = [
                            'id'            => $gid,
                            'nama_kelompok' => (string) $g->nama_kelompok,
                            'kode_badge'    => $g->kode_badge ? (string) $g->kode_badge : null,
                            'tipe_tampilan' => (string) ($g->tipe_tampilan ?: 'officers'),
                            'section_label' => $g->section_label ? (string) $g->section_label : null,
                            'is_full_width' => (int) ($g->is_full_width ?? 0),
                            'members'       => $grpMembers,
                        ];
                    }

                    foreach ($dbUnits as $u) {
                        $units[] = [
                            'slug'       => (string) $u->slug,
                            'nama'       => (string) $u->nama,
                            'deskripsi'  => (string) ($u->deskripsi ?? ''),
                            'intro_text' => $u->intro_text ? (string) $u->intro_text : null,
                            'icon'       => (string) ($u->icon ?: 'account_balance'),
                            'urutan'     => (int) ($u->urutan ?? 1),
                        ];
                    }
                }
            }
        } catch (\Throwable $e) {
            // Keep default org units/groups cleanly on fallback
        }

        foreach ($units as &$unit) {
            $slug = $unit['slug'];
            $unit['groups'] = $groupsByUnit[$slug] ?? [];
        }
        unset($unit);

        return [
            'profile' => $profile,
            'units'   => $units,
        ];
    }

    public function page()
    {
        return view('tentang', $this->getTentangData());
    }

    public function index(): JsonResponse
    {
        return response()->json($this->getTentangData());
    }
}

