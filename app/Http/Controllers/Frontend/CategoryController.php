<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    /**
     * CATEGORY LANDING PAGE
     * view: resources/views/category.blade.php
     */
    public function index()
{
    $bookmarkedIds = Auth::check()
    ? Bookmark::where('user_id', Auth::id())->pluck('book_id')->toArray()
    : [];


    $categories = Category::with([
        'books' => function ($query) {
            $query->latest()->take(4);
        }
    ])->get();

    /**
     * Transform ke SHAPE YANG FRONTEND MAU
     */
    $mappedCategories = $categories->map(function ($category) use ($bookmarkedIds) {
        return [
            'name' => $category->name,
            'slug' => $category->slug,

            'books' => $category->books->map(function ($book) use ($bookmarkedIds) {
                return [
                    'title'  => $book->title,
                    'author' => $book->author,
                    'price'  => 'Rp ' . number_format($book->final_price, 0, ',', '.'),
                    'rating' => number_format(rand(45, 50) / 10, 1), // sementara
                    'image'  => $book->cover,
                    'id'     => $book->id,
                    'slug'   => $book->slug,
                    'is_bookmarked' => in_array($book->id, $bookmarkedIds),
                ];
            })->toArray(),

            // placeholder pagination visual (sesuai mock)
            'pagination' => [
                'current' => 1,
                'hasNext' => $category->books()->count() > 4
            ]
        ];
    });

    return view('category', [
        'categories' => $mappedCategories
    ]);
}


    /**
     * CATEGORY DETAIL PAGE
     * view: resources/views/category/show.blade.php
     */
    public function show(string $slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $books = Book::where('category_id', $category->id)
        ->latest()
        ->paginate(16);

    return view('category.show', [
        'category' => $category,
        'books'    => $books
    ]);
}

}
