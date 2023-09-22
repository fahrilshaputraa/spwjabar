<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Kab;
use App\Models\Kcd;
use App\Models\Alumni;
use App\Models\Sekolah;
use App\Models\Wirausaha;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Exports\SekolahExport;
use App\Imports\SekolahImport;
use App\Exports\SekolahSiswaExport;
use App\Exports\SekolahAlumniExport;
use App\Http\Requests\ErrorSiswaAdd;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ErrorAlumniAdd;
use App\Http\Requests\ErrorSiswaUpdate;
use App\Http\Requests\ErrorAlumniUpdate;
use RealRashid\SweetAlert\Facades\Alert;

class SekolahController extends Controller
{

    public function index()
    {
        return view('sekolah.index', [
            'title' => 'Sekolah',
            'data' => Wirausaha::where('npsn_sekolah', Auth::user()->kode_user)->orderBy('omset', 'DESC')->get(),
            'label_chart' => Wirausaha::where('npsn_sekolah', Auth::user()->kode_user)->orderBy('omset', 'DESC')->take(10)->get()->pluck('nama_lengkap')->toArray(),
            'data_chart' => Wirausaha::where('npsn_sekolah', Auth::user()->kode_user)->orderBy('omset', 'DESC')->take(10)->get()->pluck('omset')->toArray(),
            'jml_siswa' => Wirausaha::where('npsn_sekolah', Auth::user()->kode_user)->get()->count(),
            'jml_alumni' => Alumni::where('npsn_sekolah', Auth::user()->kode_user)->get()->count(),
        ]);
    }
    public function siswa()
    {
        return view('sekolah.siswa', [
            'title' => 'Sekolah | Siswa',
            'data' => Wirausaha::with(['sekolah', 'sekolah.kab', 'sekolah.kab.kcd'])->where('npsn_sekolah', Auth::user()->kode_user)->latest()->get(),
            'sekolah' => Sekolah::where('npsn', Auth::user()->kode_user)->get(),
        ]);
    }
    public function siswaInsert()
    {
        return view('sekolah.siswa_insert', [
            'title' => 'Sekolah | Siswa',
            'data' => Wirausaha::with(['sekolah', 'sekolah.kab', 'sekolah.kab.kcd'])->where('npsn_sekolah', Auth::user()->kode_user)->get(),
            'sekolah' => Sekolah::where('npsn', Auth::user()->kode_user)->get(),
        ]);
    }
    public function alumniInsert()
    {
        return view('sekolah.alumni_insert', [
            'title' => 'Sekolah | Alumni',
            'sekolah' => Sekolah::where('npsn', Auth::user()->kode_user)->get(),
        ]);
    }
    public function siswaEdit($nisn)
    {
        $siswa = Wirausaha::where('nisn', $nisn)->get()->first();
        $jualan = explode(", ", $siswa->tempat_berjualan);
        return view('sekolah.siswa_update', [
            'title' => 'Sekolah | Siswa',
            'siswa' => Wirausaha::where('nisn', $nisn)->get()->first(),
            'sekolah' => Sekolah::where('npsn', Auth::user()->kode_user)->get(),
            'jualan' => $jualan,
        ]);
    }
    public function alumniEdit($id)
    {
        return view('sekolah.alumni_update', [
            'title' => 'Sekolah | edit Alumni',
            'sekolah' => Sekolah::where('npsn', Auth::user()->kode_user)->get(),
            'alumni' => Alumni::firstWhere('id_rekap', $id)
        ]);
    }
    public function alumni()
    {
        return view('sekolah.alumni', [
            'title' => 'Sekolah | Alumni',
            'data' => Alumni::with('sekolah')->where('npsn_sekolah', Auth::user()->kode_user)->get(),
            'sekolah' => Sekolah::all()
        ]);
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
            'laporan_keuangan' => 'required|file|unique:wirausahas|mimes:pdf|max:5000',
            'foto_produk' => 'required|file|unique:wirausahas|mimes:jpg,jpeg,png|max:5000',
            'deskripsi_produk' => 'required',

        ], [
            'laporan_keuangan.max' => 'Mohon maaf, File maksimal 5MB.',
            'foto_produk.max' => 'Mohon maaf, Foto maksimal 5MB.',
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
        return redirect('/sekolah/siswa');
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
            'omset' => 'required',
            'tahun_rekap' => 'required',
            'laporan_keuangan' => 'file|mimes:pdf',
            'foto_produk' => 'file|mimes:jpg,jpeg,png',
            'deskripsi_produk' => 'required',
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
            unlink('Laporan Keuangan/' . $request->old_laporan);
            $date = now()->format('d_m_Y');
            $nisn = $request->nisn;
            $exstension = $request->file('laporan_keuangan')->getClientOriginalExtension();
            $validatedData['laporan_keuangan'] = $nisn . ' ' . $date . '.' . $exstension;
            $request->file('laporan_keuangan')->move('Laporan Keuangan', $validatedData['laporan_keuangan']);
        }
        if ($request->file('foto_produk')) {
            unlink('Foto Produk/' . $request->old_foto);
            $date = now()->format('d_m_Y');
            $nisn = $request->nisn;
            $exstension = $request->file('foto_produk')->getClientOriginalExtension();
            $validatedData['foto_produk'] = $nisn . ' ' . $date . '.' . $exstension;
            $request->file('foto_produk')->move('Foto Produk', $validatedData['foto_produk']);
        }
        Wirausaha::where('nisn', $request->nisn)->update($validatedData);
        Alert::alert('Selamat!', 'Siswa berhasil di ubah', 'success');
        return redirect('/sekolah/siswa');
    }
    public function siswaDestroy(Request $request)
    {
        $siswa = Wirausaha::where('nisn', $request->id)->get()[0];
        $delLaporan = $siswa->laporan_keuangan;
        if ($delLaporan) {
            unlink('Laporan Keuangan/' . $delLaporan);
        }
        $delFoto = $siswa->foto_produk;
        if ($delFoto) {
            unlink('Foto Produk/' . $delFoto);
        }

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
        return redirect('/sekolah/alumni');
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
        return redirect('/sekolah/alumni');
    }
    public function alumniDestroy(Request $request)
    {
        $delFile = Alumni::where('id_rekap', $request->id)->get()[0]->data_excel;
        unlink('Data Excel/' . $delFile);
        Alumni::where('id_rekap', $request->id)->delete();
        return True;
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file_excel' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SekolahImport, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
        return redirect('/disdik/sekolah');
    }
    public function export()
    {
        return Excel::download(new SekolahExport, 'sekolah.xlsx');
    }


    public function importSiswa(Request $request)
    {
        $this->validate($request, [
            'file_excel' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SiswaImport, $request->file('file_excel'));

        Alert::alert('Selamat!', 'Import data berhasil', 'success');
        return redirect('/sekolah/siswa');
    }


    public function exportWirausaha()
    {
        return Excel::download(new SekolahSiswaExport, 'Siswa_SPW.xlsx');
    }
    public function exportAlumni()
    {
        return Excel::download(new SekolahAlumniExport, 'ALumni_Rekap.xlsx');
    }
}
