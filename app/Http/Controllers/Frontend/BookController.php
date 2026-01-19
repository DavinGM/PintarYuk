<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // 1. Ambil Kategori untuk Section Kategori
        $categories = Category::withCount('books')->take(4)->get();

        // 2. Ambil Buku untuk Section Card (Terbaru)
        // Kita gunakan 'latest' agar buku yang baru ditambah muncul di depan
        $products = Book::latest()->take(10)->get();

        return view('jelajah', compact('categories', 'products'));
    }

    public function show(string $slug)
    {
        $book = Book::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('book.show', compact('book'));
    }

}