<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produtos' => 'required|array',
            'produtos.*.produto_id' => 'required|integer|exists:products,id',
            'produtos.*.quantidade' => 'required|numeric|min:1',
            'produtos.*.preco' => 'required|numeric|min:0',
        ];
    }
}
