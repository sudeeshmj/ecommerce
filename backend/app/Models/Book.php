<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'author_id',
        'language_id',
        'publisher_id',
        'publishing_date',
        'edition',
        'isbn',
        'format_id',
        'pages',
        'summary',
        'image',
        'price',
        'offer_price',
        'stock',
        'threshold_stock',
        'outofstock_notify'
    ];

    // Append custom attributes to the model's array and JSON forms
    protected $appends = ['stock_text'];

    public function getStockTextAttribute()
    {

        return $this->stock == 0 ? 'Out of stock' : 'In stock';
    }

    /*public function getOfferPriceAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }*/

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
    public function format()
    {
        return $this->belongsTo(BookFormat::class, 'format_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tags', 'book_id', 'tag_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }
}
