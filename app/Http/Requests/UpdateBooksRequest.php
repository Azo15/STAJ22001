<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBooksRequest extends FormRequest
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
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'release_date' => 'required|date',
            'pages' => 'required|integer',
            'isbn' => 'required|alpha_num',
            // 'genre' => 'required|max:255',
            'in_stock' => 'required|integer',
            'cover' => 'required|url',
            'language' => 'required|max:255',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ];
    }
}
