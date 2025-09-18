<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
{
    /**
     * Kullanıcının bu isteği yapmaya yetkili olup olmadığını belirle.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * İstek için geçerli doğrulama kurallarını al.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'style' => ['required', 'string', 'max:255'],
        ];
    }
}
