<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MitraController extends Controller
{
    private function refreshExpiredMitra(): void
    {
        if (!Schema::hasTable('mitra_kerja') || !Schema::hasColumn('mitra_kerja', 'expired_at')) {
            return;
        }

        DB::table('mitra_kerja')
            ->where('status_kemitraan', 'active')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<', date('Y-m-d'))
            ->update(['status_kemitraan' => 'expired']);
    }

    public function index(): JsonResponse
    {
        if (!Schema::hasTable('mitra_kerja')) {
            return response()->json(['mitra' => []]);
        }

        $this->refreshExpiredMitra();

        $query = DB::table('mitra_kerja')->orderBy('id', 'asc');
        if (Schema::hasColumn('mitra_kerja', 'status_kemitraan')) {
            $query->where('status_kemitraan', 'active');
        }
        if (Schema::hasColumn('mitra_kerja', 'expired_at')) {
            $query->where(function ($q) {
                $q->whereNull('expired_at')
                  ->orWhere('expired_at', '>=', date('Y-m-d'));
            });
        }

        $mitraRows = $query->get();
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
                'id'               => $mId,
                'nama_perusahaan'  => $row->nama_perusahaan,
                'slug'             => $row->slug,
                'kategori_bisnis'  => $row->kategori_bisnis ?: 'Mitra Strategis Konstruksi & Konsultansi',
                'logo'             => ltrim((string) ($row->logo ?: 'assets/logo-inkindo.png'), '/'),
                'deskripsi'        => $row->deskripsi ?: '-',
                'alamat'           => $row->alamat ?: '-',
                'telepon'          => $row->telepon ?: '-',
                'email'            => $row->email ?: '-',
                'website'          => $row->website ?: '-',
                'durasi_tahun'     => (int) ($row->durasi_tahun ?? 1),
                'status_kemitraan' => $row->status_kemitraan ?? 'active',
                'expired_at'       => $row->expired_at ?? null,
                'products'         => $productsByMitra[$mId] ?? [],
            ];
        }

        return response()->json(['mitra' => $result]);
    }

    public function show(string $slug): JsonResponse
    {
        if (!Schema::hasTable('mitra_kerja')) {
            return response()->json(['message' => 'Data Mitra Kerja tidak ditemukan.'], 404);
        }

        $this->refreshExpiredMitra();

        $row = DB::table('mitra_kerja')->where('slug', $slug)->first();
        if (!$row && is_numeric($slug)) {
            $row = DB::table('mitra_kerja')->where('id', (int) $slug)->first();
        }

        if (!$row) {
            return response()->json(['message' => 'Mitra Kerja tidak ditemukan.'], 404);
        }

        $status = $row->status_kemitraan ?? 'active';
        $expiredAt = $row->expired_at ?? null;
        $isExpired = ($status === 'expired') || ($expiredAt && $expiredAt < date('Y-m-d'));

        if ($status !== 'active' || $isExpired) {
            return response()->json([
                'inactive'         => true,
                'status_kemitraan' => $isExpired ? 'expired' : $status,
                'expired_at'       => $expiredAt,
                'nama_perusahaan'  => $row->nama_perusahaan,
                'message'          => $isExpired
                    ? 'Masa berlaku kerjasama Mitra Kerja ini telah berakhir (Expired). Halaman web profil mitra dinonaktifkan secara otomatis.'
                    : 'Halaman profil Mitra Kerja ini sedang menunggu verifikasi/persetujuan Admin atau sedang tidak aktif.',
            ], 403);
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

        $otherQuery = DB::table('mitra_kerja')
            ->where('id', '!=', $row->id)
            ->orderBy('id', 'asc');

        if (Schema::hasColumn('mitra_kerja', 'status_kemitraan')) {
            $otherQuery->where('status_kemitraan', 'active');
        }
        if (Schema::hasColumn('mitra_kerja', 'expired_at')) {
            $otherQuery->where(function ($q) {
                $q->whereNull('expired_at')
                  ->orWhere('expired_at', '>=', date('Y-m-d'));
            });
        }

        $otherRows = $otherQuery->get();
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
            'inactive' => false,
            'mitra' => [
                'id'               => (int) $row->id,
                'nama_perusahaan'  => $row->nama_perusahaan,
                'slug'             => $row->slug,
                'kategori_bisnis'  => $row->kategori_bisnis ?: 'Mitra Strategis Konstruksi & Konsultansi',
                'logo'             => ltrim((string) ($row->logo ?: 'assets/logo-inkindo.png'), '/'),
                'deskripsi'        => $row->deskripsi ?: '-',
                'alamat'           => $row->alamat ?: '-',
                'telepon'          => $row->telepon ?: '-',
                'email'            => $row->email ?: '-',
                'website'          => $row->website ?: '-',
                'durasi_tahun'     => (int) ($row->durasi_tahun ?? 1),
                'status_kemitraan' => $status,
                'expired_at'       => $expiredAt,
                'products'         => $products,
            ],
            'other_mitra' => $others,
        ]);
    }

    public function storeMessage(Request $request, string $slug): JsonResponse
    {
        if (!Schema::hasTable('mitra_kerja') || !Schema::hasTable('mitra_messages')) {
            return response()->json(['message' => 'Layanan pesan belum tersedia.'], 500);
        }

        $row = DB::table('mitra_kerja')->where('slug', $slug)->first();
        if (!$row && is_numeric($slug)) {
            $row = DB::table('mitra_kerja')->where('id', (int) $slug)->first();
        }

        if (!$row) {
            return response()->json(['message' => 'Mitra Kerja tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'nama_perusahaan'  => ['required', 'string', 'max:255'],
            'email_perusahaan' => ['required', 'email', 'max:150'],
            'no_telepon'       => ['required', 'string', 'max:100'],
            'nama_pic'         => ['required', 'string', 'max:150'],
            'pesan'            => ['required', 'string', 'max:3000'],
        ]);

        DB::table('mitra_messages')->insert([
            'mitra_id'         => $row->id,
            'nama_perusahaan'  => trim($validated['nama_perusahaan']),
            'email_perusahaan' => trim($validated['email_perusahaan']),
            'no_telepon'       => trim($validated['no_telepon']),
            'nama_pic'         => trim($validated['nama_pic']),
            'pesan'            => trim($validated['pesan']),
            'is_read'          => 0,
            'created_at'       => now(),
        ]);

        return response()->json([
            'status'  => 'ok',
            'message' => 'Pesan Anda telah berhasil dikirim ke dashboard ' . $row->nama_perusahaan . '.',
        ], 201);
    }
}