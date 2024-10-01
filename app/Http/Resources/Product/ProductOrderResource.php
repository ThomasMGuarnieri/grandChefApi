<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'produto_id' => $this->product_id,
            'produto' => [
                'nome' => $this->product->name
            ],
            'quantidade' => $this->quantity,
            'preco' => $this->price / 100
        ];
    }
}
