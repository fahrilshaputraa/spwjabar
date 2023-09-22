<?php

namespace App\Imports;

use App\Models\Kab;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KabImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            Kab::create([
                'nama_kab' => $row['nama_kabupaten'],
                'id_kcd' => $row['id_kcd'],
            ]);
        }
    }
}
