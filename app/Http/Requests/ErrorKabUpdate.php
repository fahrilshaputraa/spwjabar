<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorKabUpdate extends FormRequest
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
            'nama_kab' => 'required|max:255'
        ];
    }
    public function messages(){
        return [
            'nama_kab.required' => 'Nama Kabupaten tidak boleh kosong',
            'nama_kab.max' => 'Nama Kabupaten maksimal 255 karakter',
        ]; 
    }
}
