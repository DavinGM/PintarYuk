<?php 

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Untuk Live Search (Hasil instan di Overlay)
    public function apiSearch(Request $request)
{
    $q = $request->get('q');
    if(!$q) return response()->json([]);

    // Cari di berbagai kolom
    $books = Book::where('title', 'LIKE', "%$q%")
        ->orWhere('author', 'LIKE', "%$q%")
        ->orWhere('slug', 'LIKE', "%$q%")
        ->with('category')
        ->take(6)
        ->get();

    $results = $books->map(function($book) use ($q) {
        $label = '/Title'; // Default label
        
        // Logika pendeteksi: Mana yang paling cocok dengan input user?
        if (stripos($book->author, $q) !== false) {
            $label = '/Author';
        } elseif (stripos($book->category->name, $q) !== false) {
            $label = '/Category';
        } elseif (stripos($book->slug, $q) !== false) {
            $label = '/Slug';
        }

        return [
            'title' => $book->title,
            'author' => $book->author,
            'slug' => $book->slug,
            'cover' => $book->cover, // Ingat percabangan image address vs slug_img nanti di JS
            'label' => $label,
            'url' => route('book.show', $book->slug)
        ];
    });

    return response()->json($results);
}
}