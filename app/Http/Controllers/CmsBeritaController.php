<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsBeritaController extends Controller
{
    private function formatItem(object $row): array
    {
        $tipe = (string) ($row->tipe ?? 'rilis');
        $slug = (string) ($row->slug ?? '');

        if (in_array($tipe, ['agenda', 'rilis', 'publikasi'], true)) {
            $targetUrl = 'berita-detail.html?type=' . rawurlencode($tipe) . '&id=' . rawurlencode($slug);
        } elseif ($tipe === 'emagazine') {
            $targetUrl = 'read-magazine.html?id=' . rawurlencode($slug);
        } elseif ($tipe === 'galeri') {
            $targetUrl = 'berita.html?tab=galeri&open=' . rawurlencode($slug);
        } elseif ($tipe === 'karya') {
            $targetUrl = 'berita.html?tab=karya&open=' . rawurlencode($slug);
        } else {
            $targetUrl = 'berita-detail.html?type=' . rawurlencode($tipe) . '&id=' . rawurlencode($slug);
        }

        $galeriPhotos = [];
        if (!empty($row->galeri_foto_json)) {
            $decoded = json_decode($row->galeri_foto_json, true);
            if (is_array($decoded)) {
                $galeriPhotos = array_values(array_filter($decoded));
            }
        }
        if (empty($galeriPhotos) && !empty($row->gambar)) {
            $galeriPhotos = [$row->gambar];
        }

        return [
            'id'              => (int) $row->id,
            'tipe'            => $tipe,
            'judul'           => (string) ($row->judul ?? ''),
            'slug'            => $slug,
            'kategori_label'  => (string) ($row->kategori_label ?? 'Informasi'),
            'badge'           => (string) ($row->badge ?? ''),
            'tanggal'         => $row->tanggal,
            'tanggal_label'   => (string) ($row->tanggal_label ?? ''),
            'penulis'         => (string) ($row->penulis ?? ''),
            'lokasi_meta'     => ($tipe === 'publikasi' && ($row->lokasi_meta ?? '') === 'Unduh PDF') ? 'Publikasi Resmi' : (string) ($row->lokasi_meta ?? ''),
            'waktu_kegiatan'  => (string) ($row->waktu_kegiatan ?? ''),
            'biaya_kegiatan'  => (string) ($row->biaya_kegiatan ?? ''),
            'kuota_kegiatan'  => (string) ($row->kuota_kegiatan ?? ''),
            'ukuran_file'     => (string) ($row->ukuran_file ?? ''),
            'jumlah_halaman'  => (string) ($row->jumlah_halaman ?? ''),
            'gambar'          => (string) ($row->gambar ?: 'assets/gambar.png'),
            'file_pdf'        => ($tipe === 'emagazine') ? (string) ($row->file_pdf ?? '') : '',
            'external_url'    => (string) ($row->external_url ?? ''),
            'ringkasan'       => (string) ($row->ringkasan ?? ''),
            'konten'          => (string) ($row->konten ?? ''),
            'galeri_photos'   => $galeriPhotos,
            'homepage_slot'   => (int) ($row->homepage_slot ?? 0),
            'target_url'      => $targetUrl,
        ];
    }

    public function index(Request $request): JsonResponse
    {
        $rows = DB::table('cms_berita')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        $all = [];
        $grouped = [
            'agenda'    => [],
            'rilis'     => [],
            'publikasi' => [],
            'galeri'    => [],
            'emagazine' => [],
            'karya'     => [],
        ];
        $homepage = [
            'slot_1' => null,
            'slot_2' => null,
            'slot_3' => null,
        ];

        foreach ($rows as $row) {
            $item = $this->formatItem($row);
            $all[] = $item;
            if (isset($grouped[$item['tipe']])) {
                $grouped[$item['tipe']][] = $item;
            }
            if ($item['homepage_slot'] === 1) {
                $homepage['slot_1'] = $item;
            } elseif ($item['homepage_slot'] === 2) {
                $homepage['slot_2'] = $item;
            } elseif ($item['homepage_slot'] === 3) {
                $homepage['slot_3'] = $item;
            }
        }

        $heroBanners = [];
        try {
            if (!DB::getSchemaBuilder()->hasTable('cms_hero_banners')) {
                DB::statement("
                    CREATE TABLE IF NOT EXISTS `cms_hero_banners` (
                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                        `mode_sumber` VARCHAR(20) NOT NULL DEFAULT 'custom',
                        `berita_id` INT UNSIGNED NULL DEFAULT NULL,
                        `subjudul` VARCHAR(255) NULL DEFAULT NULL,
                        `judul` VARCHAR(255) NOT NULL,
                        `gambar` VARCHAR(255) NOT NULL,
                        `target_url` VARCHAR(255) NULL DEFAULT '#berita',
                        `urutan` INT NOT NULL DEFAULT 1,
                        `is_active` TINYINT(1) NOT NULL DEFAULT 1,
                        `created_at` DATETIME NULL DEFAULT NULL,
                        `updated_at` DATETIME NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                ");
            }

            if (DB::table('cms_hero_banners')->count() === 0) {
                $now = date('Y-m-d H:i:s');
                DB::table('cms_hero_banners')->insert([
                    [
                        'mode_sumber' => 'custom',
                        'berita_id'   => null,
                        'subjudul'    => 'DPP Masa Bakti 2026–2030',
                        'judul'       => 'Dewan Pengurus Provinsi INKINDO DKI Jakarta',
                        'gambar'      => 'assets/hero-bg.jpg',
                        'target_url'  => '#tentang',
                        'urutan'      => 1,
                        'is_active'   => 1,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'mode_sumber' => 'custom',
                        'berita_id'   => null,
                        'subjudul'    => 'Kemitraan Kampus',
                        'judul'       => 'INKINDO DKI Goes to Campus',
                        'gambar'      => 'assets/gambar.png',
                        'target_url'  => '#berita',
                        'urutan'      => 2,
                        'is_active'   => 1,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'mode_sumber' => 'custom',
                        'berita_id'   => null,
                        'subjudul'    => 'Agenda Mendatang',
                        'judul'       => 'Pelatihan Audit Internal ISO 37001',
                        'gambar'      => 'assets/gambar2.jpg',
                        'target_url'  => '#berita',
                        'urutan'      => 3,
                        'is_active'   => 1,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'mode_sumber' => 'custom',
                        'berita_id'   => null,
                        'subjudul'    => 'e-Magazine Edisi 79',
                        'judul'       => 'Majalah INKINDO DKI Jakarta',
                        'gambar'      => 'assets/gambar1.jpg',
                        'target_url'  => '#berita',
                        'urutan'      => 4,
                        'is_active'   => 1,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                ]);
            }

            $bannerRows = DB::table('cms_hero_banners')
                ->where('is_active', 1)
                ->orderBy('urutan')
                ->orderBy('id')
                ->get();
            foreach ($bannerRows as $b) {
                $heroBanners[] = [
                    'id'          => (int) $b->id,
                    'mode_sumber' => (string) ($b->mode_sumber ?? 'custom'),
                    'berita_id'   => $b->berita_id ? (int) $b->berita_id : null,
                    'subjudul'    => (string) ($b->subjudul ?? ''),
                    'judul'       => (string) ($b->judul ?? ''),
                    'gambar'      => (string) ($b->gambar ?: 'assets/hero-bg.jpg'),
                    'target_url'  => (string) ($b->target_url ?: '#berita'),
                    'urutan'      => (int) ($b->urutan ?? 1),
                ];
            }
        } catch (\Throwable $e) {
            // Fallback to static HTML slides if table not yet created
        }

        $heroPhrases = [];
        try {
            if (!DB::getSchemaBuilder()->hasTable('cms_hero_phrases')) {
                DB::statement("
                    CREATE TABLE IF NOT EXISTS `cms_hero_phrases` (
                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                        `teks` VARCHAR(255) NOT NULL,
                        `urutan` INT NOT NULL DEFAULT 1,
                        `is_active` TINYINT(1) NOT NULL DEFAULT 1,
                        `created_at` DATETIME NULL DEFAULT NULL,
                        `updated_at` DATETIME NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                ");
            }
            if (DB::table('cms_hero_phrases')->count() === 0) {
                $now = date('Y-m-d H:i:s');
                DB::table('cms_hero_phrases')->insert([
                    ['teks' => 'Selamat Datang', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                    ['teks' => 'DPP INKINDO DKI Jakarta', 'urutan' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                    ['teks' => 'Ekosistem Konsultansi Digital', 'urutan' => 3, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                    ['teks' => 'Solusi Jasa Konsultansi Terpercaya', 'urutan' => 4, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                    ['teks' => 'Integritas, Inovasi & Profesionalisme', 'urutan' => 5, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ]);
            }
            $phraseRows = DB::table('cms_hero_phrases')
                ->where('is_active', 1)
                ->orderBy('urutan')
                ->orderBy('id')
                ->get();
            foreach ($phraseRows as $p) {
                if (trim((string) $p->teks) !== '') {
                    $heroPhrases[] = (string) $p->teks;
                }
            }
        } catch (\Throwable $e) {
            // Fallback to default phrases
        }

        $heroBackgrounds = [];
        try {
            if (!DB::getSchemaBuilder()->hasTable('cms_hero_backgrounds')) {
                DB::statement("
                    CREATE TABLE IF NOT EXISTS `cms_hero_backgrounds` (
                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                        `judul` VARCHAR(255) NOT NULL,
                        `gambar` VARCHAR(255) NOT NULL,
                        `urutan` INT NOT NULL DEFAULT 1,
                        `is_active` TINYINT(1) NOT NULL DEFAULT 1,
                        `created_at` DATETIME NULL DEFAULT NULL,
                        `updated_at` DATETIME NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                ");
            }
            if (DB::table('cms_hero_backgrounds')->count() === 0) {
                $now = date('Y-m-d H:i:s');
                DB::table('cms_hero_backgrounds')->insert([
                    ['judul' => 'Panorama Kota DKI Jakarta', 'gambar' => 'assets/jakartahome1.jpg', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                    ['judul' => 'Jakarta International Stadium (JIS)', 'gambar' => 'assets/jakartahome3.jpg', 'urutan' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ]);
            }
            $bgRows = DB::table('cms_hero_backgrounds')
                ->where('is_active', 1)
                ->orderBy('urutan')
                ->orderBy('id')
                ->get();
            foreach ($bgRows as $bg) {
                if (trim((string) $bg->gambar) !== '') {
                    $heroBackgrounds[] = (string) $bg->gambar;
                }
            }
        } catch (\Throwable $e) {
            // Fallback to default backgrounds
        }

        return response()->json([
            'items'            => $all,
            'grouped'          => $grouped,
            'homepage'         => $homepage,
            'hero_banners'     => $heroBanners,
            'hero_phrases'     => $heroPhrases,
            'hero_backgrounds' => $heroBackgrounds,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $row = DB::table('cms_berita')->where('slug', $slug)->first();
        if (!$row) {
            return response()->json(['message' => 'Data berita tidak ditemukan.'], 404);
        }

        $item = $this->formatItem($row);

        $relatedRows = DB::table('cms_berita')
            ->where('tipe', $item['tipe'])
            ->where('id', '!=', $item['id'])
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        $related = [];
        foreach ($relatedRows as $r) {
            $related[] = $this->formatItem($r);
        }

        return response()->json([
            'item'    => $item,
            'related' => $related,
        ]);
    }
}

