<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlumniExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alumni::select(
            'npsn_sekolah', 
            'nama_kepsek', 
            'email', 
            'no_hp_sekolah', 
            'nama_guru', 
            'nip', 
            'no_hp', 
            'jml_siswa_dibina', 
            'jml_siswa_konsisten', 
            'jml_siswa_nib', 
            'jmls_almni_pirt', 
            'jmls_almni_pengusaha', 
            'jmls_omset1', 
            'jmls_omset2', 
            'jmls_omset3', 
            'jmls_omset4', 
            'tahun_rekap')->get();
    }
    public function headings(): array
    {
        return [
            'NPSN SEKOLAH',
            'NAMA KEPSEK',
            'EMAIL',
            'NO TELP SEKOLAH',
            'NAMA GURU PEMBIMBING',
            'NIP/NUPTK/NUPPPK',
            'NO HP',
            'JUMLAH SISWA DIBINA',
            'JUMLAH SISWA KONSISTEN',
            'JUMLAH SISWA MEMILIKI NIB',
            'JUMLAH SISWA MEMILIKI PIRT',
            'JUMLAH SISWA YANG MENJADI PENGUSAHA',
            'JUMLAH SISWA OMSET 3JT+/BULAN',
            'JUMLAH SISWA OMSET 1-3JT/BULAN',
            'JUMLAH SISWA OMSET 500-1JT/BULAN',
            'JUMLAH SISWA OMSET 500/BULAN',
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
