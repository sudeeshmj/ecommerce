<?php

namespace App\Repositories;

use App\Models\BookFormat;

class BookFormatRepository
{
    public function getAllformats()
    {   
        return  BookFormat::orderBy('name','asc')
            ->select('id','name')
            ->get();
    }
}