<?php

namespace App\Http\Controllers;

use App\Exports\KabExport;
use App\Imports\KabImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KabController extends Controller
{
    public function import(Request $request) {
		$this->validate($request, [
			'file_excel' => 'required|mimes:xls,xlsx'
		]);
		
		Excel::import(new KabImport, $request->file('file_excel'));
 
        Alert::alert('Selamat!', 'Import data berhasil', 'success');
		return redirect('/disdik/kab');
	}
	public function export(){
		return Excel::download(new KabExport, 'kabupaten.xlsx');
	}
}
