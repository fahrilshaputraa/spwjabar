<?php

namespace App\Imports;

use App\Models\Sekolah;
use App\Models\Wirausaha;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $id_kab = Sekolah::where('npsn', "$row[npsn_sekolah]")->get()[0]->kab->id;
            $id_kcd = Sekolah::where('npsn', "$row[npsn_sekolah]")->get()[0]->kab->kcd->id;
            Wirausaha::create([
                'nisn' => $row['nisn'],
                'nama_lengkap' => $row['nama_lengkap'],
                'no_hp' => $row['no_hp'],
                'id_kcd' => $id_kcd,
                'id_kab' => $id_kab,
                'npsn_sekolah' => "$row[npsn_sekolah]",
                'nama_kepsek' => $row['nama_kepala_sekolah'],
                'kelas' => $row['kelas'],
                'jurusan' => $row['jurusan'],
                'jenis_usaha' => $row['jenis_usaha'],
                'merk_brand' => $row['merk_brand'],
                'tempat_berjualan' => $row['tempat_berjualan'],
                'omset' => $row['omset'],
                'nib' => $row['nib'],
                'tahun_rekap' => $row['tahun_rekap']
            ]);
            $jmlOld = Sekolah::where('npsn', "$row[npsn_sekolah]")->get()[0]->jml_wirausaha;
            Sekolah::where('npsn', "$row[npsn_sekolah]")->update(['jml_wirausaha' => $jmlOld += 1]);
        }
    }
}
