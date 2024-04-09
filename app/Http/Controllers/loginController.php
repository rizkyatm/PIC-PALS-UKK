<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $request)
    {   
        // Validasi data inputan
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah user dengan email yang diberikan ada
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Coba untuk melakukan autentikasi
            if (Auth::attempt($credentials)) {
                // Autentikasi berhasil
                $request->session()->regenerate();

                // Redirect ke halaman sesuai dengan role pengguna
                if (Auth::user()->role === 'admin') {
                    // return redirect()->intended('/Dashboard')->with('success', 'Login berhasil!');
                    return back()->withInput()->with('success', 'Login berhasil');
                } else {
                    // return redirect()->intended('/user/dashboard')->with('success', 'Login berhasil!');
                    return back()->withInput()->with('success', 'Login berhasil');
                }
            }

            // Autentikasi gagal karena password salah
            return back()->withInput()->with('error', 'Password yang anda masukan salah');
        }

        // Autentikasi gagal karena email tidak ditemukan
        return back()->withInput()->with('error', 'Email yang anda masukan tidak terdaftar');
    }


    public function logout(Request $request)
    {
        $redirectPath = '/';

        // Periksa peran pengguna saat ini
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Tentukan halaman tujuan berdasarkan peran pengguna
            if ($userRole === 'admin') {
                $redirectPath = '/login-admin';
            } else {
                $redirectPath = '/pic-pals';
            }
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectPath);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        // Autentikasi pengguna baru
        Auth::login($user);

        // Redirect ke halaman sesuai dengan peran pengguna
        if (Auth::user()->role === 'user') {
            return back()->withInput()->with('success', 'Pendaftaran dan login berhasil!');
        } 
    }

}
