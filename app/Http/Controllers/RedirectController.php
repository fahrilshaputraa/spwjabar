<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function cek(){
        if(isset(Auth::user()->level_id)){
            if (Auth::user()->level_id === '1') {
                return redirect()->intended('/admin ');
            } elseif (Auth::user()->level_id === '2') {
                return redirect()->intended('/disdik');
            } elseif (Auth::user()->level_id === '3') {
                return redirect()->intended('/kcd');
            } elseif (Auth::user()->level_id === '4') {
                return redirect()->intended('/sekolah');
            }
        }else{
            return redirect()->intended('/home');
        }
    }
}
