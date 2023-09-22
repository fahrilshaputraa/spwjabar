<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorSekolahUpdate extends FormRequest
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
            'npsn' => 'required|max:50',
            'nama_sekolah' => 'required|max:255'
        ];
    }
    public function messages(){
        return [
            'npsn.required' => 'NPSN tidak boleh kosong',
            'npsn.max' => 'NPSN maksimal 50 karakter',

            'nama_sekolah.required' => 'Nama sekolah tidak boleh kosong',
            'nama_sekolah.max' => 'Nama sekolah maksimal 255 karakter',
        ]; 
    }
}
