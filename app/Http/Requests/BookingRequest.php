<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'item_id' => ['required', 'integer', 'exists:items,id'], 
            // 'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['nullable', 'string', 'max:255'], 
            // 'start_date' => ['required', 'date', 'after:today'],
            // 'end_date' => ['required', 'date', 'after:start_date'], 
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:255'], 
            'status' => ['required', 'string', 'in:pending,confirmed,done,cancelled'],
            // 'payment_method' => ['required', 'string', 'in:midtrans,other'], 
            // 'payment_status' => ['required', 'string', 'in:pending,success,failed,expired'],
            'payment_status' => ['required', 'string', 'in:pending,success,cancelled'],
            // 'payment_url' => ['nullable', 'string', 'url'], 
            // 'total_price' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
