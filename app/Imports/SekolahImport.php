<?php

namespace App\Imports;

use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SekolahImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            Sekolah::create([
                'npsn' => $row['npsn'],
                'nama_sekolah' => $row['nama_sekolah'],
                'status' => $row['status'],
                'id_kab' => $row['id_kab'],
                'jml_wirausaha' => $row['jumlah_wirausaha'],
            ]);
        }
    }
}
