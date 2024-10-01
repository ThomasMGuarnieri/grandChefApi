<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_create_new_category(): void
    {
        $response = $this->postJson('/api/categories', [
            'nome' => 'Teste'
        ]);

        $response->assertStatus(204);
    }
}
