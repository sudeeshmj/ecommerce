<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\SubCategory;

class SubCategoryRepository
{
    public function getActiveSubCategories(): Collection
    {
        return SubCategory::where('status','1')
            ->orderBy('subcategory_name','asc')
            ->select('id','subcategory_name')
            ->get();
    }

    public function getActiveSubCategoriesByCategory(int $categoryId): Collection
    {
       return SubCategory::where('status', '1')
            ->where('category_id',$categoryId)
            ->orderBy('subcategory_name','asc')
            ->get();
    }
}