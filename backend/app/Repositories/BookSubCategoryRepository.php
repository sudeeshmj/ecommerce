<?php

namespace App\Repositories;

use App\Models\BookSubCategory;
use Carbon\Carbon;

class BookSubCategoryRepository
{
    public function saveBookSubCategories( $subCategories, $bookId)
    {    
        $currentTimestamp = Carbon::now();
        $newRows = [];
        foreach ($subCategories as $subCategory) {
            $newRows[] = [
                'book_id' => $bookId,
                'sub_category_id' => $subCategory,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ];      
        }
        BookSubCategory::insert($newRows);
    }

    public function deleteBookSubCategories( $bookId)
    {    
        BookSubCategory::where('book_id', $bookId)->delete();
    }
}