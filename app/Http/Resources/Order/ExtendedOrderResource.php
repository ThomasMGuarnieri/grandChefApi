<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductOrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExtendedOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'total' => $this->total,
            'produtos' => ProductOrderResource::collection($this->productOrders)
        ];
    }
}
