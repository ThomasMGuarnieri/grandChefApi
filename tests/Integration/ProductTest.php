<?php

namespace Tests\Integration;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_create_new_product(): void
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
    }
}
