<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorSekolahAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'npsn' => 'required|max:50|unique:sekolahs',
            'nama_sekolah' => 'required|max:255',
            'status' => 'required|max:50',
            'id_kab' => 'required|max:50',
        ];
    }
    public function messages(){
        return [
            'npsn.required' => 'NPSN tidak boleh kosong',
            'npsn.max' => 'NPSN maksimal 50 karakter',
            'npsn.unique' => 'NPSN sudah tersedia',

            'nama_sekolah.required' => 'Nama sekolah tidak boleh kosong',
            'nama_sekolah.max' => 'Nama sekolah maksimal 255 karakter',

            'status.required' => 'Pilih salah satu status',
            'status.max' => 'Status maksimal 50 karakter',

            'id_kab.required' => 'Pilih salah satu kabupaten',
            'id_kab.max' => 'Kabupaten maksimal 50 karakter',
        ]; 
    }
}
