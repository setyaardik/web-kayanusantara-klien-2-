<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'login_as' => ['required', 'in:siswa,guru'],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $user = Auth::user();

            if ($user->role !== $credentials['login_as']) {
                $peran = $user->role === 'guru' ? 'Guru' : ($user->role === 'siswa' ? 'Murid' : 'UMKM');
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors(['email' => "Akun ini terdaftar sebagai {$peran}. Silakan pilih peran yang sesuai."])->withInput();
            }

            $request->session()->regenerate();

            $next = $request->input('redirect');
            if ($next && str_starts_with($next, url('/'))) {
                return redirect($next);
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->withInput();
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('registrasi');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:siswa,guru,umkm'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
