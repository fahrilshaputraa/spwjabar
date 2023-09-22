<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorKcdAdd extends FormRequest
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
            'nama_kcd' => 'required|max:255',
            'singkatan' => 'required|max:100'
        ];
    }
    public function messages(){
        return [
            'nama_kcd.required' => 'Nama KCD tidak boleh kosong',
            'nama_kcd.max' => 'Nama KCD maksimal 255 karakter',

            'singkatan.required' => 'Singkatan tidak boleh kosong',
            'singkatan.max' => 'Singkatan maksimal 100 karakter',
        ]; 
    }
}
