<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    /**
     * Listar categorias
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Criar nova categoria
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated('nome'));

        return response(status: 204);
    }

    /**
     * Remover categoria
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return response(status: 204);
    }
}
