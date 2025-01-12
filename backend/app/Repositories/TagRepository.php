<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Tag;

class TagRepository
{
    public function getAllTags(): Collection
    {
        return Tag::orderBy('name','asc')
            ->select('id','name')
            ->get();
    }
}