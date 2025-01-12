<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function categories()
    {

        $categories = Category::where('status', '1')
            ->orderBy('category_name')
            ->select('id', 'category_name')
            ->get();

        if ($categories->isEmpty()) {
            return ApiResponseHelper::success('No categories found.', 200, []);
        }
        return ApiResponseHelper::success('Categories retrieved successfully', 200, $categories);
    }

    public function books(Request $request)
    {
        $category = $request->query('category');
        $author = $request->query('author');
        $language = $request->query('language');
        $tag = $request->query('tag');

        $query = Book::where('stock', '>', '0')
            ->where('status', '1');

        if ($category) {
            $query->where('category_id', $category);
        }
        if ($author) {
            $query->where('author_id', $author);
        }
        if ($language) {
            $query->where('language_id', $language);
        }
        if ($tag) {
            // Filter by tag using 'whereHas'
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag_id', $tag);
            });
        }

        $books = $query->select('id', 'title', 'image', 'price', 'offer_price')->get();

        //calculate discount price
        $books->each(function ($book) {
            $normalPrice = $book->price;
            $offerPrice = (int) $book->offer_price;

            if ($normalPrice && $offerPrice) {
                $discountPercentage = (($normalPrice - $offerPrice) / $normalPrice) * 100;
                $book->discount_percentage = round($discountPercentage, 0);
            }
            $book->offer_price = (int) $book->offer_price;
        });

        if ($books->isEmpty()) {
            return ApiResponseHelper::success('No books found.', 200, []);
        }
        return ApiResponseHelper::success('Books retrieved successfully', 200, $books);
    }

    public function show(int $id)
    {
        $book = Book::with([
            'tags:id,name',
            'author:id,name,bio,image',
            'publisher:id,name',
            'category:id,category_name',
            'language:id,language_name',
            'format:id,name'
        ])->where([
            ['id', '=', $id],
            ['status', '=', '1']
        ])->select([
            'id',
            'title',
            'publishing_date',
            'edition',
            'isbn',
            'pages',
            'summary',
            'image',
            'price',
            'offer_price',
            'author_id',
            'publisher_id',
            'category_id',
            'language_id',
            'format_id'
        ])->first();

        if (!$book) {
            return ApiResponseHelper::success('No book found.', 200, []);
        }
        return ApiResponseHelper::success('Book retrieved successfully', 200, $book);
    }
}
