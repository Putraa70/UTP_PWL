<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $r)
    {
        $cred = $r->validated();

        // Attempt login
        if (Auth::attempt($cred)) {

            // Regenerate session untuk keamanan
            $r->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Simpan session custom (role, name, id)
            session([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            // Flash message
            session()->flash('ok', 'Selamat datang kembali, ' . $user->name . '!');

            // Redirect sesuai role
            if ($user->role === 'ADMIN') {
                return redirect()->route('dashboard')
                    ->with('ok', 'Login sebagai ADMIN berhasil.');
            }

            return redirect()->route('dashboard')
                ->with('ok', 'Login berhasil.');
        }

        // Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    public function logout(Request $r)
    {
        // Hapus semua session custom
        $r->session()->forget(['user_id', 'user_name', 'user_role']);

        // Logout laravel
        Auth::logout();

        // Invalidate session
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()->route('login')
            ->with('ok', 'Anda telah logout.');
    }
}
