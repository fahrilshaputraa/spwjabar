<?php

namespace App\Http\Controllers;

use App\Models\Kab;
use App\Models\Sekolah;
use App\Models\Wirausaha;
use App\Exports\KcdExport;
use App\Imports\KcdImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KcdController extends Controller
{
    public function index(){
        $kab = Kab::where('id_kcd', Auth::user()->kode_user)->get();
        $id_kab = [];
        foreach ($kab as $k) {
            array_push($id_kab, $k->id);
        }
        if(count($id_kab) == 1){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orderBy('id_kab')->orderBy('jml_wirausaha', 'DESC')->get();
        }elseif(count($id_kab) == 2){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orWhere('id_kab', $id_kab[1])->orderBy('jml_wirausaha', 'DESC')->get();
        }elseif(count($id_kab)== 3){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orWhere('id_kab', $id_kab[1])->orWhere('id_kab', $id_kab[2])->orderBy('jml_wirausaha', 'DESC')->get();
        }
        return view('kcd.index', [
            'title' => 'KCD',
            'data' => $sekolah,
            'kab' => Kab::where('id_kcd', Auth::user()->kode_user)->get()->count(),
            'sekolah' => $sekolah->count(),
            'siswa' => Wirausaha::where('id_kcd', Auth::user()->kode_user)->get()->count()
        ]);
    }
    public function kab(){
        return view('kcd.kab', [
            'title' => 'KCD | Kab/Kot',
            'data' => Kab::with('kcd')->where('id_kcd', Auth::user()->kode_user)->orderBy('nama_kab')->get()
        ]);
    }
    public function sekolah(){
        $kab = Kab::where('id_kcd', Auth::user()->kode_user)->get();
        $id_kab = [];
        foreach ($kab as $k) {
            array_push($id_kab, $k->id);
        }
        if(count($id_kab) == 1){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orderBy('id_kab')->orderBy('nama_sekolah')->get();
        }elseif(count($id_kab) == 2){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orWhere('id_kab', $id_kab[1])->orderBy('id_kab')->orderBy('nama_sekolah')->get();
        }elseif(count($id_kab)== 3){
            $sekolah = Sekolah::with('kab')->where('id_kab', $id_kab[0])->orWhere('id_kab', $id_kab[1])->orWhere('id_kab', $id_kab[2])->orderBy('id_kab')->orderBy('nama_sekolah')->get();
        }
        return view('kcd.sekolah', [
            'title' => 'KCD | Sekolah',
            'data' => $sekolah
        ]);
    }

    public function import(Request $request) {
		$this->validate($request, [
			'file_excel' => 'required|mimes:xls,xlsx'
		]);

		Excel::import(new KcdImport, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
		return redirect('/disdik/kcd');
	}
    public function export(){
		return Excel::download(new KcdExport, 'kcd.xlsx');
	}
}
