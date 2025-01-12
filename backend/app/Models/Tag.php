<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = ['pivot'];
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_tags', 'tag_id', 'book_id');
    }
}
