<?php

use App\Http\Controllers\AuthController;
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

// Serve static asset directories directly from workspace root (with fallback to SistemManajemenDataPT/public/mitra_logos)
Route::get('/{folder}/{path}', function (string $folder, string $path) {
    $fullPath = realpath(base_path("{$folder}/{$path}"));
    $allowedRoot = realpath(base_path($folder));

    if (!$fullPath || !$allowedRoot || !str_starts_with($fullPath, $allowedRoot) || !File::isFile($fullPath)) {
        if ($folder === 'mitra_logos') {
            $altRoot = realpath('d:/magang inkindo/SistemManajemenDataPT/public/mitra_logos');
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
})->where('folder', 'assets|css|js|mitra_logos')->where('path', '.*');

// Helper to serve workspace HTML pages seamlessly
$serveHtmlPage = function (string $filename) {
    $path = base_path($filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response(File::get($path), 200)
        ->header('Content-Type', 'text/html; charset=UTF-8')
        ->header('Cache-Control', 'no-cache, must-revalidate');
};

// Home page
Route::get('/', fn () => $serveHtmlPage('index.html'));
Route::get('/index.html', fn () => $serveHtmlPage('index.html'));

// Anggota Terdaftar page
Route::get('/anggota-terdaftar', fn () => $serveHtmlPage('anggota-terdaftar.html'));
Route::get('/anggota-terdaftar.html', fn () => $serveHtmlPage('anggota-terdaftar.html'));

// Halaman Detail Profil Masing-Masing Mitra Kerja (contoh: /mitra-kerja/pt-granitoguna-building-ceramics)
Route::get('/mitra-kerja/{slug}', fn () => $serveHtmlPage('mitra-detail.html'));
Route::get('/mitra-detail.html', fn () => $serveHtmlPage('mitra-detail.html'));

// Other static HTML pages
$staticPages = [
    'tentang',
    'regulasi',
    'berita',
    'berita-detail',
    'ketentuan-mitra-kerja',
    'lelang-lainnya',
    'read-magazine',
];

foreach ($staticPages as $page) {
    Route::get("/{$page}", fn () => $serveHtmlPage("{$page}.html"));
    Route::get("/{$page}.html", fn () => $serveHtmlPage("{$page}.html"));
}