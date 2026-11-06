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

        return response()->json([
            'items'    => $all,
            'grouped'  => $grouped,
            'homepage' => $homepage,
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

