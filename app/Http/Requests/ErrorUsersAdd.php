<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorUsersAdd extends FormRequest
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
            'name' => 'required|max:100',
            'username' => 'required|min:6|max:100|unique:users',
            'password' => 'required|min:6|max:100',
            'kode_user' => 'required',
            'level_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 100 karakter',
            
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 6 karakter',
            'username.max' => 'Username maksimal 100 karakter',
            'username.unique' => 'Username sudah digunakan',
            
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 100 karakter',

            'kode_user.required' => 'Instansi tidak boleh kosong',
        ]; 
    }
}
