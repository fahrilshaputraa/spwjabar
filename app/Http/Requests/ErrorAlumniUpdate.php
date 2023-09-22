<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorAlumniUpdate extends FormRequest
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
            'nama_kepsek' => 'required',
            'email' => 'required|email',
            'no_hp_sekolah' => 'required',
            'nama_guru' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'jml_siswa_dibina' => 'required',
            'jml_siswa_konsisten' => 'required',
            'jml_siswa_nib' => 'required',
            'jmls_almni_pengusaha' => 'required',
            'jmls_almni_pirt' => 'required',
            'jmls_omset1' => 'required',
            'jmls_omset2' => 'required',
            'jmls_omset3' => 'required',
            'jmls_omset4' => 'required',
            'data_excel' => 'file|mimes:xls,xlt,xlsx,xlsb,xlsm,xltx,xltm',
            'tahun_rekap' => 'required',
        ];
    }
    public function messages(){
        return [
            'nama_kepsek.required' => 'Nama Kepala Sekolah tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Yang anda masukkan bukan email',
            'no_hp_sekolah.required' => 'No Telp Sekolah tidak boleh kosong',
            'nama_guru.required' => 'Nama Guru tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'no_hp.required' => 'NoHp tidak boleh kosong',
            'jml_siswa_dibina.required' => 'Jumlah siswa SPW tidak boleh kosong',
            'jml_siswa_konsisten.required' => 'Jumlah siswa konsisten tidak boleh kosong',
            'jml_siswa_nib.required' => 'Jumlah siswa punya NIB tidak boleh kosong',
            'jmls_almni_pengusaha.required' => 'Jumlah alumni pengusaha tidak boleh kosong',
            'jmls_almni_pirt.required' => 'Jumlah alumni PIRT tidak boleh kosong',
            'jmls_omset1.required' => 'Jumlah siswa omset >3Jt tidak boleh kosong',
            'jmls_omset2.required' => 'Jumlah siswa omset 1-3Jt tidak boleh kosong',
            'jmls_omset3.required' => 'Jumlah siswa omset 500K-1Jt tidak boleh kosong',
            'jmls_omset4.required' => 'Jumlah siswa omset 500K tidak boleh kosong',
            'data_excel.mimes' => 'Harap masukkan file dengan format (xls,xlt,xlsx,xlsb,xlsm,xltx,xltm) ',
            'tahun_rekap.required' => 'Tahun rekap tidak boleh kosong',
        ]; 
    }
}
