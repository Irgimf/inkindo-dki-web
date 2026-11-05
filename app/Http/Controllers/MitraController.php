<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MitraController extends Controller
{
    public function index(): JsonResponse
    {
        if (!Schema::hasTable('mitra_kerja')) {
            return response()->json(['mitra' => []]);
        }

        $mitraRows = DB::table('mitra_kerja')->orderBy('id', 'asc')->get();
        $productsByMitra = [];

        if (Schema::hasTable('mitra_products')) {
            $productRows = DB::table('mitra_products')->orderBy('id', 'asc')->get();
            foreach ($productRows as $prod) {
                $mId = (int) $prod->mitra_id;
                $productsByMitra[$mId][] = [
                    'id'               => (int) $prod->id,
                    'nama_produk'      => $prod->nama_produk,
                    'kategori_produk'  => $prod->kategori_produk ?: 'Produk Unggulan',
                    'deskripsi_produk' => $prod->deskripsi_produk ?: '-',
                    'spesifikasi'      => $prod->spesifikasi ?: '-',
                    'gambar_produk'    => ltrim((string) ($prod->gambar_produk ?: ''), '/'),
                ];
            }
        }

        $result = [];
        foreach ($mitraRows as $row) {
            $mId = (int) $row->id;
            $result[] = [
                'id'              => $mId,
                'nama_perusahaan' => $row->nama_perusahaan,
                'slug'            => $row->slug,
                'kategori_bisnis' => $row->kategori_bisnis ?: 'Mitra Strategis Konstruksi & Konsultansi',
                'logo'            => ltrim((string) ($row->logo ?: 'assets/logo-inkindo.png'), '/'),
                'deskripsi'       => $row->deskripsi ?: '-',
                'alamat'          => $row->alamat ?: '-',
                'telepon'         => $row->telepon ?: '-',
                'email'           => $row->email ?: '-',
                'website'         => $row->website ?: '-',
                'products'        => $productsByMitra[$mId] ?? [],
            ];
        }

        return response()->json(['mitra' => $result]);
    }

    public function show(string $slug): JsonResponse
    {
        if (!Schema::hasTable('mitra_kerja')) {
            return response()->json(['message' => 'Data Mitra Kerja tidak ditemukan.'], 404);
        }

        $row = DB::table('mitra_kerja')->where('slug', $slug)->first();
        if (!$row && is_numeric($slug)) {
            $row = DB::table('mitra_kerja')->where('id', (int) $slug)->first();
        }

        if (!$row) {
            return response()->json(['message' => 'Mitra Kerja tidak ditemukan.'], 404);
        }

        $products = [];
        if (Schema::hasTable('mitra_products')) {
            $prodRows = DB::table('mitra_products')->where('mitra_id', $row->id)->orderBy('id', 'asc')->get();
            foreach ($prodRows as $prod) {
                $products[] = [
                    'id'               => (int) $prod->id,
                    'nama_produk'      => $prod->nama_produk,
                    'kategori_produk'  => $prod->kategori_produk ?: 'Produk Unggulan',
                    'deskripsi_produk' => $prod->deskripsi_produk ?: '-',
                    'spesifikasi'      => $prod->spesifikasi ?: '-',
                    'gambar_produk'    => ltrim((string) ($prod->gambar_produk ?: $row->logo), '/'),
                ];
            }
        }

        $otherRows = DB::table('mitra_kerja')
            ->where('id', '!=', $row->id)
            ->orderBy('id', 'asc')
            ->get();

        $others = [];
        foreach ($otherRows as $o) {
            $others[] = [
                'id'              => (int) $o->id,
                'nama_perusahaan' => $o->nama_perusahaan,
                'slug'            => $o->slug,
                'kategori_bisnis' => $o->kategori_bisnis ?: 'Mitra Kerja',
                'logo'            => ltrim((string) ($o->logo ?: 'assets/logo-inkindo.png'), '/'),
            ];
        }

        return response()->json([
            'mitra' => [
                'id'              => (int) $row->id,
                'nama_perusahaan' => $row->nama_perusahaan,
                'slug'            => $row->slug,
                'kategori_bisnis' => $row->kategori_bisnis ?: 'Mitra Strategis Konstruksi & Konsultansi',
                'logo'            => ltrim((string) ($row->logo ?: 'assets/logo-inkindo.png'), '/'),
                'deskripsi'       => $row->deskripsi ?: '-',
                'alamat'          => $row->alamat ?: '-',
                'telepon'         => $row->telepon ?: '-',
                'email'           => $row->email ?: '-',
                'website'         => $row->website ?: '-',
                'products'        => $products,
            ],
            'other_mitra' => $others,
        ]);
    }
}