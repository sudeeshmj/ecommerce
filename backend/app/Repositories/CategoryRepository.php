<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getActiveCategories()
    {
        return Category::where('status','1')
            ->orderBy('category_name','asc')
            ->select('id','category_name')
            ->get();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function getById($id)
    {
        return Category::find($id);
    }
}