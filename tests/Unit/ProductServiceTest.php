<?php

namespace Tests\Unit;

use App\Services\ProductService;
use PHPUnit\Framework\TestCase;
use TypeError;

class ProductServiceTest extends TestCase
{
    public function test_cents_conversion(): void
    {
        $productService = new ProductService();

        $this->assertEquals(1000, $productService->convertPriceToCents(10.00));
        $this->assertEquals(1000, $productService->convertPriceToCents(10));
        $this->assertEquals(999, $productService->convertPriceToCents(9.99));
        $this->assertEquals(10000, $productService->convertPriceToCents(100.00));
        $this->assertEquals(10001, $productService->convertPriceToCents(100.01));
    }

    public function test_cents_wrong_type()
    {
        $productService = new ProductService();

        $this->expectException(TypeError::class);

        $productService->convertPriceToCents('teste');
    }
}
