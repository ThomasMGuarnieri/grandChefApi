<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create(string $name): Category
    {
        $category = new Category();
        $category->name = $name;
        $category->save();

        return $category;
    }

    public function delete(Category $category): Category
    {
        $category->delete();

        return $category;
    }
}
