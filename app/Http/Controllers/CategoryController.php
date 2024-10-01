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
     * Retorna uma lista com todas as categorias
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Insere uma nova categoria
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated('nome'));

        return response(status: 204);
    }

    /**
     * Remove uma categoria já cadastrada
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return response(status: 204);
    }
}
