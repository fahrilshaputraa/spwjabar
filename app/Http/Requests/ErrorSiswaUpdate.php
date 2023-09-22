<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorSiswaUpdate extends FormRequest
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
            'laporan_keuangan' => 'file|unique:wirausahas|mimes:pdf',
            'foto_produk' => 'file|unique:wirausahas|mimes:jpg,jpeg,png',
            'deskripsi_produk' => 'required',
        ];
    }
    public function messages(){
        return [
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.min' => 'NISN minimal 10 karakter',
            'nisn.max' => 'NISN maksimal 15 karakter',

            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'no_hp.required' => 'NoHp tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'nama_kepsek.required' => 'Nama Kepala Sekolah tidak boleh kosong',
            'merk_brand.required' => 'Merk/Brand tidak boleh kosong',
            'omset.required' => 'Omset tidak boleh kosong',
            'tahun_rekap.required' => 'Tahun rekap tidak boleh kosong',
            'laporan_keuangan.mimes' => 'Yang kamu masukkan bukan pdf',
            'foto_produk.mimes' => 'Yang kamu masukan bukang gambar (jpg, jpeg, png)',
            'deskripsi_produk.required' => 'Deskripsi produk tidak boleh kosong'
        ]; 
    }
}
