<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required','string','max:255','unique:orders,code'],
            'customer_id' => ['required','integer','exists:customers,id'],
            'total' => ['required','numeric','min:0'],
            'status' => ['required','string','in:draft,confirmed,canceled'],  
        ];
    }

     public function messages(): array
    {
        return [
            'code.unique' => 'Ya existe un pedido con ese código.',
        ];
    }
}
