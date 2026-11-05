<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
}

