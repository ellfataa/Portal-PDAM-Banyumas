<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'not_regex:/[0-9]/'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email:rfc',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Kustomisasi pesan error validasi agar berbahasa Indonesia dan mudah dipahami.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.not_regex' => 'Nama lengkap tidak boleh mengandung angka.',
            'email.email'    => 'Format alamat email tidak valid (harus mengandung tanda "@" dan domain).',
        ];
    }
}
