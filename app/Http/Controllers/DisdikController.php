<?php

namespace App\Http\Controllers;

use App\Models\Kab;
use App\Models\Kcd;
use App\Models\Alumni;
use App\Models\Sekolah;
use App\Models\Wirausaha;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Exports\AlumniExport;
use App\Http\Requests\ErrorKabAdd;
use App\Http\Requests\ErrorKcdAdd;
use App\Http\Requests\ErrorSiswaAdd;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ErrorAlumniAdd;
use App\Http\Requests\ErrorKabUpdate;
use App\Http\Requests\ErrorSekolahAdd;
use App\Http\Requests\ErrorSiswaUpdate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ErrorAlumniUpdate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ErrorSekolahUpdate;
use Illuminate\Support\Facades\File;

class DisdikController extends Controller
{
    public function index()
    {
        return view('disdik.index', [
            'title' => 'Disdik',
            'kcd' => Kcd::all()->count(),
            'kab' => Kab::all()->count(),
            'sekolah' => Sekolah::all()->count(),
            'siswa' => Wirausaha::all()->count(),
            'alumni' => Alumni::all()->count(),
            'kcdi' => Wirausaha::where('id_kcd', '1001')->count(),
            'kcdii' => Wirausaha::where('id_kcd', '1002')->count(),
            'kcdiii' => Wirausaha::where('id_kcd', '1003')->count(),
            'kcdiv' => Wirausaha::where('id_kcd', '1004')->count(),
            'kcdv' => Wirausaha::where('id_kcd', '1005')->count(),
            'kcdvi' => Wirausaha::where('id_kcd', '1006')->count(),
            'kcdvii' => Wirausaha::where('id_kcd', '1007')->count(),
            'kcdviii' => Wirausaha::where('id_kcd', '1008')->count(),
            'kcdix' => Wirausaha::where('id_kcd', '1009')->count(),
            'kcdx' => Wirausaha::where('id_kcd', '1010')->count(),
            'kcdxi' => Wirausaha::where('id_kcd', '1011')->count(),
            'kcdxii' => Wirausaha::where('id_kcd', '1012')->count(),
            'kcdxiii' => Wirausaha::where('id_kcd', '1013')->count(),
        ]);
    }
    public function kcd()
    {
        return view('disdik.kcd', [
            'title' => 'Disdik | KCD',
            'data' => Kcd::all()
        ]);
    }
    public function kab()
    {
        return view('disdik.kab', [
            'title' => 'Disdik | Kabupaten/Kota',
            'data' => Kab::with('kcd')->get(),
            'kcd' => Kcd::all()
        ]);
    }
    public function sekolah()
    {
        return view('disdik.sekolah', [
            'title' => 'Disdik | Sekolah',
            'data' => Sekolah::with(['kab', 'kab.kcd'])->get(),
            'kab' => Kab::all(),
        ]);
    }
    public function siswa()
    {
        return view('disdik.siswa', [
            'title' => 'Disdik | Siswa',
            'data' => Wirausaha::with(['sekolah', 'sekolah.kab', 'sekolah.kab.kcd'])->get(),
            'kcd' => Kcd::all()
        ]);
    }
    public function alumni()
    {
        return view('disdik.alumni', [
            'title' => 'Disdik | Alumni',
            'data' => Alumni::with('sekolah')->get(),
            'sekolah' => Sekolah::all()
        ]);
    }




    public function kcdStore(ErrorKcdAdd $request)
    {
        $validatedData = $request->validate([
            'nama_kcd' => 'required|max:255',
            'singkatan' => 'required|max:100'
        ]);
        Kcd::create($validatedData);
        Alert::alert('Selamat!', 'KCD berhasil di tambahkan', 'success');
        return redirect('/disdik/kcd');
    }
    public function getKcd(Request $request)
    {
        return Kcd::where('id', $request->id)->get();
    }
    public function kcdUpdate(ErrorKcdAdd $request)
    {
        $validatedData = $request->validate([
            'nama_kcd' => 'required|max:255',
            'singkatan' => 'required|max:100'
        ]);
        Kcd::where('id', $request->id)->update($validatedData);
        Alert::alert('Selamat!', 'KCD berhasil di ubah', 'success');
        return redirect('/disdik/kcd');
    }
    public function kcdDestroy(Request $request)
    {
        Kcd::destroy($request->id);
        return True;
    }


    public function kabStore(ErrorKabAdd $request)
    {
        $validatedData = $request->validate([
            'nama_kab' => 'required|max:255',
            'id_kcd' => 'required|max:100',
        ]);
        Kab::create($validatedData);
        Alert::alert('Selamat!', 'Kabupaten berhasil di tambahkan', 'success');
        return redirect('/disdik/kab');
    }
    public function getKab(Request $request)
    {
        return Kab::where('id', $request->id)->get();
    }
    public function kabUpdate(ErrorKabUpdate $request)
    {
        $validatedData = $request->validate([
            'nama_kab' => 'required|max:255'
        ]);
        if ($request->id_kcd) {
            $validatedData['id_kcd'] = $request->id_kcd;
        }
        Kab::where('id', $request->id)->update($validatedData);
        Alert::alert('Selamat!', 'Kabupaten berhasil di ubah', 'success');
        return redirect('/disdik/kab');
    }
    public function kabDestroy(Request $request)
    {
        Kab::destroy($request->id);
        return True;
    }


    public function sekolahStore(ErrorSekolahAdd $request)
    {
        $validatedData = $request->validate([
            'npsn' => 'required|max:50|unique:sekolahs',
            'nama_sekolah' => 'required|max:255',
            'status' => 'required|max:50',
            'id_kab' => 'required|max:50',
        ]);
        Sekolah::create($validatedData);
        Alert::alert('Selamat!', 'Sekolah berhasil di tambahkan', 'success');
        return redirect('/disdik/sekolah');
    }
    public function getSekolah(Request $request)
    {
        return Sekolah::where('npsn', $request->id)->get();
    }
    public function sekolahUpdate(ErrorSekolahUpdate $request)
    {
        $validatedData = $request->validate([
            'npsn' => 'required|max:50',
            'nama_sekolah' => 'required|max:255'
        ]);
        if ($request->status) {
            $validatedData['status'] = $request->status;
        };
        if ($request->id_kab) {
            $validatedData['id_kab'] = $request->id_kab;
        };
        Sekolah::where('npsn', $request->npsn)->update($validatedData);
        Alert::alert('Selamat!', 'Kabupaten berhasil di ubah', 'success');
        return redirect('/disdik/sekolah');
    }
    public function sekolahDestroy(Request $request)
    {
        Sekolah::where('npsn', $request->id)->delete();
        return True;
    }




    public function getKabs(Request $request)
    {
        return Kab::where('id_kcd', $request->id)->get();
    }
    public function getSekolahs(Request $request)
    {
        return Sekolah::where('id_kab', $request->id)->get();
    }
    public function siswaStore(ErrorSiswaAdd $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|min:10|max:15|unique:wirausahas',
            'nama_lengkap' => 'required',
            'id_kcd' => 'required',
            'id_kab' => 'required',
            'npsn_sekolah' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'nama_kepsek' => 'required',
            'no_hp' => 'required',
            'jenis_usaha' => 'required',
            'merk_brand' => 'required',
            'omset' => 'required',
            'tempat_berjualan' => 'required',
            'nib' => '',
            'tahun_rekap' => 'required',
            'laporan_keuangan' => 'required|file|unique:wirausahas|mimes:pdf',
            'foto_produk' => 'required|file|unique:wirausahas|mimes:jpg,jpeg,png',
            'deskripsi_produk' => 'required',
            'link_produk' => 'required',
        ]);
        if ($request->jenis_usaha == "Lainnya") {
            $validatedData['jenis_usaha'] = $request->usahaLainnya;
        }
        $tempat = '';
        foreach ($request->tempat_berjualan as $tmp) {
            if ($tmp == "Lainnya") {
                $tmp = $request->tempatLainnya;
            }
            $tempat = $tempat . $tmp . ', ';
        }

        $jmlOld = Sekolah::where('npsn', $request->npsn_sekolah)->get()[0]->jml_wirausaha;
        Sekolah::where('npsn', $request->npsn_sekolah)->update(['jml_wirausaha' => $jmlOld += 1]);
        $validatedData['tempat_berjualan'] = $tempat;

        $date = now()->format('d_m_Y');
        $siswa = $request->nisn;
        // File
        $exstension = $request->file('laporan_keuangan')->getClientOriginalExtension();
        $validatedData['laporan_keuangan'] = $siswa . ' ' . $date . '.' . $exstension;

        $request->file('laporan_keuangan')->move('Laporan Keuangan', $validatedData['laporan_keuangan']);
        // Foto
        $exstension = $request->file('foto_produk')->getClientOriginalExtension();
        $validatedData['foto_produk'] = $siswa . ' ' . $date . '.' . $exstension;

        $request->file('foto_produk')->move('Foto Produk', $validatedData['foto_produk']);
        // Insert
        Wirausaha::create($validatedData);
        Alert::alert('Selamat!', 'Siswa berhasil di tambahkan', 'success');
        return redirect('/disdik/siswa');
    }
    public function getSiswa(Request $request)
    {
        return Wirausaha::where('nisn', $request->id)->get();
    }
    public function siswaUpdate(ErrorSiswaUpdate $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|min:10|max:15',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'nama_kepsek' => 'required',
            'merk_brand' => 'required',
            'nib' => '',
            'omset' => '',
            'tahun_rekap' => 'required',
            'laporan_keuangan' => 'file|mimes:pdf',
            'foto_produk' => 'file|mimes:jpg,jpeg,png',
            'deskripsi_produk' => 'required',
            'link_produk' => 'required',
        ]);
        if ($request->jenis_usaha == "Lainnya") {
            $validatedData['jenis_usaha'] = $request->usahaLainnya;
        } else if ($request->jenis_usaha) {
            $validatedData['jenis_usaha'] = $request->jenis_usaha;
        }

        if ($request->tempat_berjualan) {
            $tempat = '';
            foreach ($request->tempat_berjualan as $tmp) {
                if ($tmp == "Lainnya") {
                    $tmp = $request->tempatLainnya;
                }
                $tempat = $tempat . $tmp . ', ';
            }
            $validatedData['tempat_berjualan'] = $tempat;
        }
        if ($request->file('laporan_keuangan')) {
            File::delete(public_path('./Laporan Keuangan/' . $request->old_laporan));
            // unlink('Laporan Keuangan/'.$request->old_laporan);
            $date = now()->format('d_m_Y');
            $nisn = $request->nisn;
            $exstension = $request->file('laporan_keuangan')->getClientOriginalExtension();
            $validatedData['laporan_keuangan'] = $nisn . ' ' . $date . '.' . $exstension;
            $request->file('laporan_keuangan')->move('Laporan Keuangan', $validatedData['laporan_keuangan']);
        }
        if ($request->file('foto_produk')) {
            File::delete(public_path('./Foto Produk/' . $request->old_foto));
            // unlink('Foto Produk/'.$request->old_foto);
            $date = now()->format('d_m_Y');
            $nisn = $request->nisn;
            $exstension = $request->file('foto_produk')->getClientOriginalExtension();
            $validatedData['foto_produk'] = $nisn . ' ' . $date . '.' . $exstension;
            $request->file('foto_produk')->move('Foto Produk', $validatedData['foto_produk']);
        }
        Wirausaha::where('nisn', $request->nisn)->update($validatedData);
        Alert::alert('Selamat!', 'Siswa berhasil di ubah', 'success');
        return redirect('/disdik/siswa');
    }
    public function siswaDestroy(Request $request)
    {
        $siswa = Wirausaha::where('nisn', $request->id)->get()[0];
        $delLaporan = $siswa->laporan_keuangan;
        unlink('Laporan Keuangan/' . $delLaporan);
        $delFoto = $siswa->foto_produk;
        unlink('Foto Produk/' . $delFoto);

        $jmlOld = Sekolah::where('npsn', $request->npsn_sekolah)->get()[0]->jml_wirausaha;
        Sekolah::where('npsn', $request->npsn_sekolah)->update(['jml_wirausaha' => $jmlOld -= 1]);
        Wirausaha::where('nisn', $request->id)->delete();
        return True;
    }



    public function alumniStore(ErrorAlumniAdd $request)
    {
        $validatedData = $request->validate([
            'npsn_sekolah' => 'required',
            'nama_kepsek' => 'required',
            'email' => 'required|email',
            'no_hp_sekolah' => 'required',
            'nama_guru' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'jml_siswa_dibina' => 'required',
            'jml_siswa_konsisten' => 'required',
            'jml_siswa_nib' => 'required',
            'jmls_almni_pengusaha' => 'required',
            'jmls_almni_pirt' => 'required',
            'jmls_omset1' => 'required',
            'jmls_omset2' => 'required',
            'jmls_omset3' => 'required',
            'jmls_omset4' => 'required',
            'data_excel' => 'required|file|unique:alumnis|mimes:xls,xlsx',
            'tahun_rekap' => 'required',
        ]);

        $date = now()->format('d_m_Y');
        $sekolah = Sekolah::where('npsn', $request->npsn_sekolah)->get()[0]->nama_sekolah;
        $exstension = $request->file('data_excel')->getClientOriginalExtension();
        $validatedData['data_excel'] = $sekolah . ' ' . $date . '.' . $exstension;

        $request->file('data_excel')->move('Data Excel', $validatedData['data_excel']);

        Alumni::create($validatedData);
        Alert::alert('Selamat!', 'Rekap Alumni berhasil di tambahkan', 'success');
        return redirect('/disdik/alumni');
    }
    public function getAlumni(Request $request)
    {
        return Alumni::where('id_rekap', $request->id)->get();
    }
    public function alumniUpdate(ErrorAlumniUpdate $request)
    {
        $validatedData = $request->validate([
            'nama_kepsek' => 'required',
            'email' => 'required|email',
            'no_hp_sekolah' => 'required',
            'nama_guru' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'jml_siswa_dibina' => 'required',
            'jml_siswa_konsisten' => 'required',
            'jml_siswa_nib' => 'required',
            'jmls_almni_pengusaha' => 'required',
            'jmls_almni_pirt' => 'required',
            'jmls_omset1' => 'required',
            'jmls_omset2' => 'required',
            'jmls_omset3' => 'required',
            'jmls_omset4' => 'required',
            'data_excel' => 'file|mimes:xls,xlt,xlsx,xlsb,xlsm,xltx,xltm',
            'tahun_rekap' => 'required',
        ]);

        if ($request->file('data_excel')) {
            unlink('Data Excel/' . $request->old_file);
            $date = now()->format('d_m_Y');
            $sekolah = Sekolah::where('npsn', $request->old_npsn)->get()[0]->nama_sekolah;
            $exstension = $request->file('data_excel')->getClientOriginalExtension();
            $validatedData['data_excel'] = $sekolah . ' ' . $date . '.' . $exstension;
            $request->file('data_excel')->move('Data Excel', $validatedData['data_excel']);
        }
        if ($request->npsn_sekolah) {
            $validatedData['npsn_sekolah'] = $request->npsn_sekolah;

            $date = now()->format('d_m_Y');
            $sekolah = Sekolah::where('npsn', $request->npsn_sekolah)->get()[0]->nama_sekolah;
            $exstension = explode('.', $request->old_file)[1];
            $newFileName = $sekolah . ' ' . $date . '.' . $exstension;
            rename('Data Excel/' . $request->old_file, 'Data Excel/' . $newFileName);
            $validatedData['data_excel'] = $newFileName;
        }
        Alumni::where('id_rekap', $request->id_rekap)->update($validatedData);
        Alert::alert('Selamat!', 'Rekap Alumni berhasil di tambahkan', 'success');
        return redirect('/disdik/alumni');
    }
    public function alumniDestroy(Request $request)
    {
        $delFile = Alumni::where('id_rekap', $request->id)->get()[0]->data_excel;
        unlink('Data Excel/' . $delFile);
        Alumni::where('id_rekap', $request->id)->delete();
        return True;
    }


    public function importSiswa(Request $request)
    {
        $this->validate($request, [
            'file_excel' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SiswaImport, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
        return redirect('/disdik/siswa');
    }


    public function exportWirausaha()
    {
        return Excel::download(new SiswaExport, 'Siswa_SPW.xlsx');
    }
    public function exportAlumni()
    {
        return Excel::download(new AlumniExport, 'ALumni_Rekap.xlsx');
    }
}
