<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function getAllAuthors()
    {
        return Author::orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();
    }
}
