<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'total'
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatusEnum::class
        ];
    }

    public function productOrders(): HasMany
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function getTotal()
    {
        return $this->productOrders()->sum('price');
    }
}
