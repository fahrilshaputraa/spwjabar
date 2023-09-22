<?php

namespace App\Imports;

use App\Models\Kcd;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KcdImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            Kcd::create([
                'id' => $row['id'],
                'nama_kcd' => $row['nama_kcd'],
                'singkatan' => $row['singkatan'],
            ]);
        }
    }
}
