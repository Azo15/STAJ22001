<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UpdateRentalRequest extends FormRequest
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
            'status' => ['required', 'string', 'in:Pending Review,Approved,Returned,Overdue,Cancelled'],
            'rental_start_at' => ['nullable', 'date_format:Y-m-d\TH:i'], // Formatın girişle eşleştiğinden emin olun
            'rental_due_at' => ['nullable', 'date_format:Y-m-d\TH:i'],   // Formatın girişle eşleştiğinden emin olun
            'returned_at' => ['nullable', 'date_format:Y-m-d\TH:i'],     // Formatın girişle eşleştiğinden emin olun
        ];
    }
}
