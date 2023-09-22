<?php

namespace App\Http\Controllers;

use App\Models\Kab;
use App\Models\Kcd;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()->level_id === '1') {
            $kab = '-';
            $kcd = '-';
            $sekolah = '';
        } elseif (Auth::user()->level_id === '2') {
            $kab =  Kab::all()->count();
            $kcd = Kcd::all()->count();
            $sekolah = Sekolah::all()->count();
        } elseif (Auth::user()->level_id === '3') {
            $kab = Kab::firstWhere('id_kcd', Auth::user()->kode_user)->count();
            $id_kab = Kab::firstWhere('id_kcd', Auth::user()->kode_user)->id;
            $kcd  = '-';
            $sekolah =  Sekolah::where('id_kab', $id_kab)->get()->count();
        } else {
            $kab = Sekolah::firstWhere('npsn', Auth::user()->kode_user)->kab->nama_kab;
            $kcd = Sekolah::firstWhere('npsn', Auth::user()->kode_user)->kab->kcd->singkatan;
            $sekolah = Sekolah::firstWhere('npsn', Auth::user()->kode_user)->status;
        }

        return view('profile.index', [
            'title' => 'Disdik',
            'data' => User::firstWhere('kode_user', Auth::user()->kode_user),
            'kab' => $kab,
            'kcd' => $kcd,
            'sekolah' => $sekolah
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Masukan password lama.',
            'new_password.required' => 'Masukan password baru.',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai.'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password lama tidak sesuai.'])->withInput();
        }

        if (Hash::check($request->new_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.'])->withInput();
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Alert::alert('Selamat!', 'Password berhasil di ubah', 'success');
        return back();
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'photo_profile' => 'file|image|max:5024'
        ], ['photo_profile.max' => 'Maksimal gambar 5mb']);

        if ($request->file('photo_profile')) {
            if ($request->oldImage) {
                unlink(public_path($request->oldImage));
            }

            $imagePath = 'Photo_profile/';
            $imageName = $request->file('photo_profile')->getClientOriginalName();
            $request->file('photo_profile')->move(public_path($imagePath), $imageName);

            User::whereId(Auth::user()->id)->update(['photo_profile' => $imagePath . $imageName]);
        }

        Alert::alert('Selamat!', 'Foto profile berhasil di ubah', 'success');
        return back();
    }
}
