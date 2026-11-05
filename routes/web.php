<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Redirect Login & Register to SistemManajemenDataPT (http://localhost:8080)
Route::get('/login', fn () => redirect()->away('http://localhost:8080/auth/login'));
Route::get('/auth/login', fn () => redirect()->away('http://localhost:8080/auth/login'));
Route::get('/register', fn () => redirect()->away('http://localhost:8080/auth/register'));
Route::get('/auth/register', fn () => redirect()->away('http://localhost:8080/auth/register'));

// Member Directory API endpoint (read-only for public Web Profile; CRUD managed via SistemManajemenDataPT)
Route::get('/api/members', [MemberController::class, 'index']);

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
