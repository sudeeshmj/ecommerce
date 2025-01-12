<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function create(array $data)
    {
        return Book::create($data);
    }
    
    public function update($id, array $data)
    {
      
        $book = Book::findOrFail($id);
        $book->update($data);

        return $book; 
    }
}