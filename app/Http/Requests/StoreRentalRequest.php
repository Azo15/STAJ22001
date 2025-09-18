<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StoreRentalRequest extends FormRequest
{
    // Doğrulama için verileri hazırla.
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(),
            'books_id' => $this->route('book')->id,
            'status' => 'Pending Review',
            'rental_requested_at' => now(),
        ]);
    }
    
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
            'user_id' => ['required', 'exists:users,id'],
            'books_id' => ['required', 'exists:books,id'],
            'status' => ['required', 'string', 'in:Pending Review,Approved,Returned,Overdue,Cancelled'],
            'rental_requested_at' => ['required'],
            'rental_start_at' => ['nullable', 'date'],
            'rental_due_at' => ['nullable', 'date'],
            'returned_at' => ['nullable', 'date'],
        ];
    }
}
