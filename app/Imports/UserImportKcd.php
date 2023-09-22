<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImportKcd implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            User::create([
                'name' => $row['name'],
                'username' => $row['username'],
                'password' => Hash::make($row['password']),
                'kode_user' => $row['kode_user'],
                'level_id' => '3',
            ]);
        }
    }
}
