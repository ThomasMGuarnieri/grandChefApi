<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function create(float $price, string $name, int $category_id)
    {
        $product = new Product([
            'name' => $name,
            'price' => $this->convertPriceToCents($price),
        ]);

        $product->category()->associate($category_id);
        $product->save();
    }

    public function convertPriceToCents(float $price): int
    {
        return $price * 100;
    }

    public function delete(Product $product): Product
    {
        $product->delete();

        return $product;
    }
}
