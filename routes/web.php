<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
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

// Helper to serve workspace HTML pages seamlessly
$serveHtmlPage = function (string $filename) {
    $path = base_path($filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response(File::get($path), 200)->header('Content-Type', 'text/html; charset=UTF-8');
};

// Home page
Route::get('/', fn () => $serveHtmlPage('index.html'));
Route::get('/index.html', fn () => $serveHtmlPage('index.html'));

// Anggota Terdaftar page
Route::get('/anggota-terdaftar', fn () => $serveHtmlPage('anggota-terdaftar.html'));
Route::get('/anggota-terdaftar.html', fn () => $serveHtmlPage('anggota-terdaftar.html'));

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
