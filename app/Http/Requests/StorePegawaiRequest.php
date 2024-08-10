<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email',
            'roles' => 'required|string',
            'start_date' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'documents' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'roles.required' => 'Role harus dipilih.',
            'roles.string' => 'Role harus berupa string.',
            'start_date.required' => 'Tanggal mulai bekerja harus diisi.',
            'start_date.date' => 'Tanggal mulai bekerja tidak valid.',
            'photo.required' => 'Foto harus diunggah.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Gambar harus memiliki salah satu ekstensi: jpeg, png, jpg, gif, svg.',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'documents.required' => 'Dokumen harus diunggah.',
            'documents.file' => 'Dokumen harus berupa file.',
            'documents.mimes' => 'Dokumen harus memiliki salah satu ekstensi: pdf, doc, docx, txt.',
            'documents.max' => 'Ukuran dokumen tidak boleh lebih dari 2MB.',
        ];
    }
}
