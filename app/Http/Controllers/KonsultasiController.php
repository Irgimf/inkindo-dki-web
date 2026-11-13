<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KonsultasiController extends Controller
{
    private function ensureTable(): void
    {
        if (Schema::hasTable('konsultasi_messages')) {
            return;
        }

        DB::statement("
            CREATE TABLE IF NOT EXISTS `konsultasi_messages` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `kategori` VARCHAR(150) NOT NULL,
                `nama` VARCHAR(150) NOT NULL,
                `nama_perusahaan` VARCHAR(255) NOT NULL,
                `no_telepon` VARCHAR(100) NOT NULL,
                `email` VARCHAR(150) NOT NULL,
                `subject` VARCHAR(255) NOT NULL,
                `pesan` TEXT NOT NULL,
                `is_read` TINYINT(1) NOT NULL DEFAULT 0,
                `created_at` DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    public function storeMessage(Request $request): JsonResponse
    {
        $this->ensureTable();

        $validated = $request->validate([
            'kategori'        => ['required', 'string', 'max:150'],
            'nama'            => ['required', 'string', 'max:150'],
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'no_telepon'      => ['required', 'string', 'max:100'],
            'email'           => ['required', 'email', 'max:150'],
            'subject'         => ['required', 'string', 'max:255'],
            'pesan'           => ['required', 'string', 'max:3000'],
        ]);

        DB::table('konsultasi_messages')->insert([
            'kategori'        => trim($validated['kategori']),
            'nama'            => trim($validated['nama']),
            'nama_perusahaan' => trim($validated['nama_perusahaan']),
            'no_telepon'      => trim($validated['no_telepon']),
            'email'           => trim($validated['email']),
            'subject'         => trim($validated['subject']),
            'pesan'           => trim($validated['pesan']),
            'is_read'         => 0,
            'created_at'      => now(),
        ]);

        return response()->json([
            'status'  => 'ok',
            'message' => 'Permohonan konsultasi Anda berhasil dikirim ke Admin DPP INKINDO DKI Jakarta.',
        ], 201);
    }
}

