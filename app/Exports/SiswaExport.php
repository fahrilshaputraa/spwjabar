<?php

namespace App\Exports;

use App\Models\Wirausaha;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Wirausaha::select(
            'nisn',
            'nama_lengkap', 
            'no_hp',
            'npsn_sekolah', 
            'nama_kepsek', 
            'kelas', 
            'jurusan', 
            'jenis_usaha', 
            'merk_brand', 
            'tempat_berjualan', 
            'omset', 
            'nib', 
            'tahun_rekap'
            )->get();
    }
    public function headings(): array
    {
        return [
            'NISN',
            'NAMA LENGKAP',
            'NO HP',
            'NPSN SEKOLAH',
            'NAMA KEPALA SEKOLAH',
            'KELAS',
            'JURUSAN',
            'JENIS USAHA',
            'MERK/BRAND',
            'TEMPAT BERJUALAN',
            'OMSET',
            'NIB',
            'TAHUN REKAP',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}
