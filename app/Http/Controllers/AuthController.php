<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private function ensureSsoTable(): void
    {
        if (Schema::hasTable('sso_tokens')) {
            return;
        }

        DB::statement("
            CREATE TABLE IF NOT EXISTS `sso_tokens` (
                `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `user_id` BIGINT UNSIGNED NOT NULL,
                `token` VARCHAR(128) NOT NULL,
                `target_app` VARCHAR(20) NOT NULL DEFAULT 'web',
                `redirect_to` VARCHAR(255) NOT NULL DEFAULT '/',
                `expires_at` DATETIME NOT NULL,
                `used_at` DATETIME NULL DEFAULT NULL,
                `created_at` DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `sso_tokens_token_unique` (`token`),
                KEY `sso_tokens_user_expires_idx` (`user_id`, `expires_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    private function sanitizeRedirectPath(?string $path): string
    {
        $path = trim((string) $path);
        if ($path === '' || !str_starts_with($path, '/') || str_starts_with($path, '//')) {
            return '/';
        }
        return $path;
    }

    /**
     * Check current authentication status & provide CSRF token.
     */
    public function status(Request $request)
    {
        $user = Auth::user();

        return response()->json([
            'authenticated' => Auth::check(),
            'user' => $user ? [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'role' => $user->role,
            ] : null,
            'sim_url' => rtrim((string) config('app.sim_url', 'http://localhost:8080'), '/'),
            'csrf_token' => csrf_token(),
        ]);
    }

    /**
     * Handle Admin Kesekretariatan Login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $user = Auth::user();
            if (!in_array($user->role, ['super_admin', 'admin'], true)) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun ini bukan akun Admin Kesekretariatan.',
                ], 403);
            }
            $request->session()->regenerate();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang, ' . $user->name . '.',
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'name' => $user->name,
                        'role' => $user->role,
                    ],
                    'csrf_token' => csrf_token(),
                ]);
            }

            return redirect()->intended('/anggota-terdaftar');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah. Silakan coba lagi.',
            ], 422);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Handle Admin Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Anda telah berhasil logout dari Mode Admin Kesekretariatan.',
                'csrf_token' => csrf_token(),
            ]);
        }

        return redirect('/');
    }

    /**
     * Consume a one-time SSO token issued by sim-inkindo-dki.
     */
    public function ssoCallback(Request $request)
    {
        $this->ensureSsoTable();
        $token = trim((string) $request->query('token', ''));

        if ($token === '') {
            return redirect('/');
        }

        $row = DB::table('sso_tokens')
            ->where('token', hash('sha256', $token))
            ->where('target_app', 'web')
            ->whereNull('used_at')
            ->where('expires_at', '>=', now())
            ->first();

        if (!$row) {
            return redirect('/')->with('sso_error', 'Sesi login tidak valid atau sudah kedaluwarsa. Silakan login kembali.');
        }

        $updated = DB::table('sso_tokens')
            ->where('id', $row->id)
            ->whereNull('used_at')
            ->update(['used_at' => now()]);

        if ($updated === 0) {
            return redirect('/');
        }

        Auth::loginUsingId($row->user_id);
        $request->session()->regenerate();

        $redirectTo = $this->sanitizeRedirectPath($row->redirect_to ?? '/');
        return redirect($redirectTo);
    }

    /**
     * Issue a one-time SSO token to switch into sim-inkindo-dki.
     */
    public function switchToSim(Request $request)
    {
        $simUrl = rtrim((string) config('app.sim_url', 'http://localhost:8080'), '/');

        if (!Auth::check()) {
            return redirect()->away($simUrl . '/auth/login');
        }

        $this->ensureSsoTable();
        $plainToken = Str::random(64);

        DB::table('sso_tokens')->insert([
            'user_id'     => Auth::id(),
            'token'       => hash('sha256', $plainToken),
            'target_app'  => 'sim',
            'redirect_to' => '/',
            'expires_at'  => now()->addMinutes(2),
            'used_at'     => null,
            'created_at'  => now(),
        ]);

        return redirect()->away($simUrl . '/auth/sso?token=' . urlencode($plainToken));
    }

    /**
     * Global logout across both inkindo-dki-web and sim-inkindo-dki.
     */
    public function ssoLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $simUrl = rtrim((string) config('app.sim_url', 'http://localhost:8080'), '/');

        if ($request->query('from') === 'sim') {
            $portal = $request->query('portal') === 'mitra' ? '/mitra/login' : '/auth/login';
            return redirect()->away($simUrl . $portal);
        }

        return redirect()->away($simUrl . '/auth/logout?redirect_web=1');
    }
}

