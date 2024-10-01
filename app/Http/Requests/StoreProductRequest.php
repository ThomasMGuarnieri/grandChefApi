<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id' => 'required|integer|exists:categories,id',
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
        ];
    }
}
