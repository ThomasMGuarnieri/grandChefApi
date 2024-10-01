<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    /**
     * Lista todos os produtos cadastrados
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Insere um novo produto
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->create(
            $request->validated('preco'),
            $request->validated('nome'),
            $request->validated('categoria_id')
        );

        return response(status: 204);
    }

    /**
     * Remove um produto cadastrado
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return response(status: 204);
    }
}
