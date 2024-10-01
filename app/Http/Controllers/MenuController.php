<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryMenuResource;
use App\Models\Category;

class MenuController extends Controller
{
    public function list()
    {
        return CategoryMenuResource::collection(Category::query()->paginate());
    }
}
