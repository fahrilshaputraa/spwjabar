<?php

namespace App\Http\Controllers;

use App\Models\Kcd;
use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Exports\UserExportKcd;
use App\Imports\UserImportKcd;
use App\Exports\UserExportDisdik;
use App\Http\Requests\ErrorUsers;
use App\Imports\UserImportDisdik;
use App\Exports\UserExportSekolah;
use App\Imports\UserImportSekolah;
use App\Http\Requests\ErrorUsersAdd;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ErrorUsersUpdate;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index', [
            'title' => 'Admin',
            'data' => User::with(['level', 'sekolah', 'kcd'])->get(),
            'disdik' => User::where('level_id', '2')->count(),
            'kcd' => User::where('level_id', '3')->count(),
            'sekolah' => User::where('level_id', '4')->count(),
        ]);
    }
    public function disdik(){
        return view('admin.disdik', [
            'title' => 'Admin | Disdik',
            'data' => User::where('level_id', '2')->get()
        ]);
    }
    public function kcd(){
        return view('admin.kcd', [
            'title' => 'Admin | KCD',
            'data' => User::with(['level', 'kcd'])->where('level_id', '3')->get(),
            'kcd' => Kcd::all()
        ]);
    }
    public function sekolah(){
        return view('admin.sekolah', [
            'title' => 'Admin | Sekolah',
            'data' => User::with(['level', 'sekolah'])->where('level_id', '4')->get(),
            'sekolah' => Sekolah::all()
        ]);
    }

    public function getUser(Request $request){
        return User::where('id', $request->id)->get();
    }
    public function store(ErrorUsersAdd $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|min:6|max:100|unique:users',
            'password' => 'required|min:6|max:100',
            'kode_user' => 'required',
            'level_id' => 'required'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        Alert::alert('Selamat!', 'User berhasil di tambahkan', 'success');
        if($request->level_id == '2'){
            return redirect('/admin/disdik');
        }else if($request->level_id == '3'){
            return redirect('/admin/kcd');
        }else{
            return redirect('/admin/sekolah');
        }
    }
    public function update(ErrorUsersUpdate $request, $id){
        $level_id = User::where('id', $id)->get()[0]->level_id;
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|min:6|max:100',
        ]);
        if ($request->password){
            $validatedData['password'] = Hash::make($request->password);
        }
        if ($request->kode_user){
            $validatedData['kode_user'] = $request->kode_user;
        }
        User::where('id', $id)->update($validatedData);
        Alert::alert('Selamat!', 'User berhasil di ubah', 'success');
        if($level_id == '2'){
            return redirect('/admin/disdik');
        }else if($level_id == '3'){
            return redirect('/admin/kcd');
        }else{
            return redirect('/admin/sekolah');
        }
    }
    public function destroy($id){
        User::destroy($id); 
        return $id;
    }


    public function importDisdik(Request $request) {
		$this->validate($request, [
			'file_excel' => 'required|mimes:xls,xlsx'
		]);

		Excel::import(new UserImportDisdik, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
		return redirect('/admin/disdik');
	}
    public function importKcd(Request $request) {
		$this->validate($request, [
			'file_excel' => 'required|mimes:xls,xlsx'
		]);

		Excel::import(new UserImportKcd, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
		return redirect('/admin/kcd');
	}
    public function importSekolah(Request $request) {
		$this->validate($request, [
			'file_excel' => 'required|mimes:xls,xlsx'
		]);

		Excel::import(new UserImportSekolah, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
		return redirect('/admin/sekolah');
	}


    public function exportDisdik(){
		return Excel::download(new UserExportDisdik, 'User_Disdik.xlsx');
	}
    public function exportKcd(){
		return Excel::download(new UserExportKcd, 'User_Kcd.xlsx');
	}
    public function exportSekolah(){
		return Excel::download(new UserExportSekolah, 'User_Sekolah.xlsx');
	}
}
