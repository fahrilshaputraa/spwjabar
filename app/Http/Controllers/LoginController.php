<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Login\RememberMeExpiration;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'SPW Jawa Barat'
        ]);
    }

    public function login()
    {
        return view('login', [
            'title' => 'SPW Jawa Barat | Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();
            Alert::toast('Login berhasil!', 'success')->autoClose(3000)->position('top-start')->timerProgressBar();

            if ($request->input('remember')) {
                setcookie('remember', 'true', time() + 7200);
                setcookie('username', $credentials['username'], time() + 7200);
                setcookie('password', $credentials['password'], time() + 7200);
            } else {
                setcookie('username', '', time() - 7200);
                setcookie('password', '', time() - 7200);
            }

            if (Auth::user()->level_id === '1') {
                return redirect()->intended('/admin');
            } elseif (Auth::user()->level_id === '2') {
                return redirect()->intended('/disdik');
            } elseif (Auth::user()->level_id === '3') {
                return redirect()->intended('/kcd');
            } else {
                return redirect()->intended('/sekolah');
            }
        }

        return back()->withErrors([
            'username' => ('Username yang dimasukkan Salah!'),
            'password' => ('Password yang dimasukkan Salah!')
        ]);
    }

    public function logout(Request $request)
    {
        // Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
