<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorSiswaAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
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
        ];
    }
    public function messages(){
        return [
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.min' => 'NISN minimal 10 karakter',
            'nisn.max' => 'NISN maksimal 15 karakter',
            'nisn.unique' => 'NISN sudah tersedia',

            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'id_kcd.required' => 'Pilih salah satu KCD',
            'id_kab.required' => 'Pilih salah satu Kabupaten',
            'npsn_sekolah.required' => 'Pilih salah satu Sekolah',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'nama_kepsek.required' => 'Nama Kepala Sekolah tidak boleh kosong',
            'no_hp.required' => 'NoHp tidak boleh kosong',
            'jenis_usaha.required' => 'Pilih salah satu jenis usaha',
            'merk_brand.required' => 'Merk/Brand tidak boleh kosong',
            'omset.required' => 'Omset tidak boleh kosong',
            'tempat_berjualan.required' => 'Pilih minimal satu tempat berjualan',
            'tahun_rekap.required' => 'Tahun rekap tidak boleh kosong',
            'laporan_keuangan.required' => 'Laporan keuangan tidak boleh kosong',
            'laporan_keuangan.unique' => 'Laporan keuangan sudah tersedia',
            'laporan_keuangan.mimes' => 'Yang kamu masukkan bukan pdf',
            'foto_produk.required' => 'Foto Produk tidak boleh kosong',
            'foto_produk.unique' => 'Foto Produk sudah tersedia',
            'foto_produk.mimes' => 'Yang kamu masukan bukang gambar (jpg, jpeg, png)',
            'deskripsi_produk.required' => 'Deskripsi produk tidak boleh kosong'
        ]; 
    }
}
