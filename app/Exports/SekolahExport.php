<?php

namespace App\Exports;

use App\Models\Sekolah;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SekolahExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sekolah::select(
            'npsn', 
            'nama_sekolah', 
            'status', 
            'id_kab', 
            'jml_wirausaha'
            )->get();
    }
    public function headings(): array
    {
        return [
            'NPSN',
            'NAMA SEKOLAH',
            'STATUS',
            'ID KABUPATEN',
            'JUMLAH WIRAUSAHA',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}
