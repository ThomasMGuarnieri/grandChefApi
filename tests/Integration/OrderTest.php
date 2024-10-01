<?php

namespace Tests\Integration;

use App\Enums\OrderStatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_create_new_order(): void
    {
        $response = $this->postJson('/api/categories', [
            'nome' => 'Teste'
        ]);

        $response->assertStatus(204);

        $category = Category::query()->first();

        $response = $this->postJson('/api/products', [
            'categoria_id' => $category->id,
            'nome' => 'Água',
            'preco' => 3.50
        ]);

        $response->assertStatus(204);

        $product = Product::query()->first();


        $response = $this->postJson('/api/orders', [
            'produtos' => [
                [
                    'produto_id' => $product->id,
                    'quantidade' => 2,
                    'preco' => 3.50
                ],
                [
                    'produto_id' => $product->id,
                    'quantidade' => 1,
                    'preco' => 2.50
                ]
            ]
        ]);

        $response->assertStatus(201);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('id');
            $json->has('status');
            $json->has('produtos', 2);
            $json->has('total');
            $json->has('produtos.0.produto.nome');
        });

        $this->assertEquals(OrderStatusEnum::ABERTO->value, $response->json('status'));
        $this->assertEquals(600, $response->json('total'));
        $this->assertEquals('Água', $response->json('produtos.0.produto.nome'));
    }
}
