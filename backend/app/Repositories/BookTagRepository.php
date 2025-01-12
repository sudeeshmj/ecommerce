<?php

namespace App\Repositories;

use App\Models\BookTag;
use Carbon\Carbon;

class BookTagRepository
{
    public function saveBookTags( $bookTags, $bookId)
    {    
        $currentTimestamp = Carbon::now();
        $newRows =[];
        foreach ($bookTags as $bookTag) {
           
            $newRows[] = [
                'book_id' => $bookId,
                'tag_id' => $bookTag,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ];  
        }
        BookTag::insert($newRows);
    }
    public function deleteBookTags( $bookId)
    {    
        BookTag::where('book_id', $bookId)->delete();
    }
}