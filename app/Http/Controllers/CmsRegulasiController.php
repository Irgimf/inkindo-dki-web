<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CmsRegulasiController extends Controller
{
    /**
     * Fallback data saat tabel cms_regulasi belum dibuat oleh Admin CMS CI4.
     *
     * @return array<int, object>
     */
    private function defaultRegulasi(): array
    {
        return [
            (object) [
                'id'           => 1,
                'kategori'     => 'inkindo',
                'sub_kategori' => null,
                'judul'        => 'Anggaran Dasar / Anggaran Rumah Tangga (AD/ART) INKINDO',
                'deskripsi'    => 'Pedoman pokok keorganisasian yang memuat ketentuan kelembagaan, hak dan kewajiban anggota, tata kelola asosiasi, serta mekanisme pengambilan keputusan di lingkungan INKINDO.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 2,
                'kategori'     => 'inkindo',
                'sub_kategori' => null,
                'judul'        => 'Kode Etik Anggota INKINDO',
                'deskripsi'    => 'Standar norma etika dan perilaku profesional yang wajib dipatuhi oleh seluruh anggota dalam menjalankan kegiatan dan praktik jasa konsultansi secara berintegritas.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 3,
                'kategori'     => 'inkindo',
                'sub_kategori' => null,
                'judul'        => 'Pedoman Organisasi Provinsi INKINDO DKI Jakarta',
                'deskripsi'    => 'Aturan operasional dan tata kerja organisasi tingkat provinsi dalam penyelenggaraan pelayanan anggota, koordinasi kepengurusan, serta program strategis DKI Jakarta.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 4,
                'kategori'     => 'jasa',
                'sub_kategori' => 'kontruksi',
                'judul'        => 'UU No. 2 Tahun 2017 tentang Jasa Konstruksi',
                'deskripsi'    => 'Landasan hukum utama penyelenggaraan jasa konstruksi nasional yang mengatur ketentuan perizinan usaha, standar mutu dan keamanan, serta tata kelola industri konstruksi.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 5,
                'kategori'     => 'jasa',
                'sub_kategori' => 'non-kontruksi',
                'judul'        => 'Pedoman Pengadaan Jasa Konsultansi Non Konstruksi',
                'deskripsi'    => 'Petunjuk teknis tata cara pemilihan penyedia, penyusunan kualifikasi teknis, dan evaluasi penawaran untuk pengadaan jasa konsultansi bidang non-konstruksi.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 6,
                'kategori'     => 'jasa',
                'sub_kategori' => 'umum',
                'judul'        => 'Standar Remunerasi (Billing Rate) Jasa Konsultansi 2026',
                'deskripsi'    => 'Pedoman acuan perhitungan remunerasi minimal tenaga ahli dan biaya langsung non-personil berbasis keahlian dalam perencanaan anggaran dan proposal lelang konsultansi.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 7,
                'kategori'     => 'jasa',
                'sub_kategori' => 'kontruksi',
                'judul'        => 'PP No. 22 Tahun 2020 tentang Peraturan Pelaksanaan UU Jasa Konstruksi',
                'deskripsi'    => 'Peraturan pelaksanaan undang-undang jasa konstruksi yang mengatur perizinan berusaha, sertifikasi kompetensi kerja, tata kelola rantai pasok, dan pengawasan proyek.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 8,
                'kategori'     => 'jasa',
                'sub_kategori' => 'umum',
                'judul'        => 'Standar Biaya Langsung Personil & Non Personil 2026',
                'deskripsi'    => 'Rincian komponen batas biaya langsung personil menurut jenjang pendidikan dan pengalaman kerja, serta rincian biaya penunjang operasional kegiatan konsultansi.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 9,
                'kategori'     => 'terkait',
                'sub_kategori' => null,
                'judul'        => 'Peraturan LKPP No. 12 Tahun 2021 tentang Pedoman Pengadaan Barang/Jasa Pemerintah',
                'deskripsi'    => 'Pedoman pelaksanaan pengadaan barang dan jasa melalui penyedia, tata kelola tender jasa konsultansi, negosiasi teknis, serta penyusunan kontrak kerja pemerintah.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
            (object) [
                'id'           => 10,
                'kategori'     => 'terkait',
                'sub_kategori' => null,
                'judul'        => 'Peraturan Menteri PUPR No. 10 Tahun 2021 tentang Pedoman SMKK',
                'deskripsi'    => 'Pedoman penerapan Sistem Manajemen Keselamatan Konstruksi (SMKK) untuk menjamin pemenuhan standar keselamatan keteknikan, kesehatan kerja, dan keberlanjutan lingkungan.',
                'file_pdf'     => null,
                'file_name'    => null,
            ],
        ];
    }

    /**
     * @return array<int, object>
     */
    private function loadItems(): array
    {
        try {
            if (Schema::hasTable('cms_regulasi')) {
                return DB::table('cms_regulasi')
                    ->orderByDesc('id')
                    ->get()
                    ->all();
            }
        } catch (\Throwable $e) {
            // Fallback ke data default jika koneksi DB belum siap
        }

        return $this->defaultRegulasi();
    }

    /**
     * @param array<int, object> $items
     * @return array<string, array<int, object>>
     */
    private function groupByKategori(array $items): array
    {
        $grouped = [
            'inkindo' => [],
            'jasa'    => [],
            'terkait' => [],
        ];

        foreach ($items as $item) {
            $kat = $item->kategori ?? 'inkindo';
            if (! array_key_exists($kat, $grouped)) {
                $kat = 'inkindo';
            }
            $grouped[$kat][] = $item;
        }

        return $grouped;
    }

    public function page(): View
    {
        return view('regulasi', [
            'regulasiByKategori' => $this->groupByKategori($this->loadItems()),
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data'   => $this->loadItems(),
        ]);
    }
}

