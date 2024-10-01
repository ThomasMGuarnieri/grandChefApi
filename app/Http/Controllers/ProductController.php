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
     * Lista produtos
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Cria novo produto
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
     * Remove produto
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return response(status: 204);
    }
}
