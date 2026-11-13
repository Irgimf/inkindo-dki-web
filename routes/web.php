<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CmsBeritaController;
use App\Http\Controllers\CmsKetentuanMitraController;
use App\Http\Controllers\CmsLelangController;
use App\Http\Controllers\CmsRegulasiController;
use App\Http\Controllers\CmsTentangController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MitraController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Authentication API endpoints
Route::get('/api/auth/status', [AuthController::class, 'status']);
Route::post('/api/auth/login', [AuthController::class, 'login']);
Route::post('/api/auth/logout', [AuthController::class, 'logout']);

// Member CRUD API endpoints
Route::get('/api/members', [MemberController::class, 'index']);
Route::post('/api/members', [MemberController::class, 'store']);
Route::put('/api/members/{member}', [MemberController::class, 'update']);
Route::delete('/api/members/{member}', [MemberController::class, 'destroy']);

// Mitra Kerja API endpoints
Route::get('/api/mitra', [MitraController::class, 'index']);
Route::get('/api/mitra/{slug}', [MitraController::class, 'show']);
Route::post('/api/mitra/{slug}/messages', [MitraController::class, 'storeMessage'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);

// CMS Berita & Informasi API endpoints
Route::get('/api/cms/berita', [CmsBeritaController::class, 'index']);
Route::get('/api/cms/berita/{slug}', [CmsBeritaController::class, 'show']);

// CMS Tentang Kami API endpoint
Route::get('/api/cms/tentang', [CmsTentangController::class, 'index']);
// CMS Regulasi API endpoint
Route::get('/api/cms/regulasi', [CmsRegulasiController::class, 'index']);
// CMS Lelang Lainnya API endpoint
Route::get('/api/cms/lelang', [CmsLelangController::class, 'index']);
// CMS Ketentuan Mitra Kerja API endpoint
Route::get('/api/cms/ketentuan-mitra', [CmsKetentuanMitraController::class, 'index']);

// Fallback static asset handler (serves from public/ or falls back to sim-inkindo-dki/public)
Route::get('/{folder}/{path}', function (string $folder, string $path) {
    $allowedRoot = realpath(public_path($folder));
    $fullPath = $allowedRoot ? realpath(public_path("{$folder}/{$path}")) : false;

    if (!$fullPath || !$allowedRoot || !str_starts_with($fullPath, $allowedRoot) || !File::isFile($fullPath)) {
        if (in_array($folder, ['mitra_logos', 'cms_uploads'], true)) {
            $altRoot = realpath(base_path('../sim-inkindo-dki/public/' . $folder));
            $altFull = $altRoot ? realpath($altRoot . DIRECTORY_SEPARATOR . $path) : false;
            if ($altFull && $altRoot && str_starts_with($altFull, $altRoot) && File::isFile($altFull)) {
                $fullPath = $altFull;
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    $mimeMap = [
        'css' => 'text/css; charset=UTF-8',
        'js' => 'application/javascript; charset=UTF-8',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'pdf' => 'application/pdf',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
    ];

    $headers = [
        'Cache-Control' => 'no-cache, must-revalidate',
    ];
    if (isset($mimeMap[$ext])) {
        $headers['Content-Type'] = $mimeMap[$ext];
    }

    return response()->file($fullPath, $headers);
})->where('folder', 'assets|css|js|mitra_logos|cms_uploads')->where('path', '.*');

// Home page
Route::get('/', fn () => view('index'));
Route::get('/index.html', fn () => view('index'));

// Anggota Terdaftar page
Route::get('/anggota-terdaftar', fn () => view('anggota-terdaftar'));
Route::get('/anggota-terdaftar.html', fn () => view('anggota-terdaftar'));

// Halaman Detail Profil Masing-Masing Mitra Kerja (contoh: /mitra-kerja/pt-granitoguna-building-ceramics)
Route::get('/mitra-kerja/{slug}', fn () => view('mitra-detail'));
Route::get('/mitra-detail.html', fn () => view('mitra-detail'));

// Dynamic Tentang Kami page (driven by Admin CMS)
Route::get('/tentang', [CmsTentangController::class, 'page']);
Route::get('/tentang.html', [CmsTentangController::class, 'page']);

// Dynamic Regulasi page (driven by Admin CMS)
Route::get('/regulasi', [CmsRegulasiController::class, 'page']);
Route::get('/regulasi.html', [CmsRegulasiController::class, 'page']);

// Dynamic Lelang Lainnya page (driven by Admin CMS)
Route::get('/lelang-lainnya', [CmsLelangController::class, 'page']);
Route::get('/lelang-lainnya.html', [CmsLelangController::class, 'page']);

// Dynamic Ketentuan Mitra Kerja page (driven by Admin CMS)
Route::get('/ketentuan-mitra-kerja', [CmsKetentuanMitraController::class, 'page']);
Route::get('/ketentuan-mitra-kerja.html', [CmsKetentuanMitraController::class, 'page']);

// Other static pages
$staticPages = [
    'berita',
    'berita-detail',
    'read-magazine',
    'pencarian',
];

foreach ($staticPages as $page) {
    Route::get("/{$page}", fn () => view($page));
    Route::get("/{$page}.html", fn () => view($page));
}