<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Menampilkan halaman jelajah dengan 4 kategori utama.
     */
    public function index()
    {
        // Ambil hanya 4 kategori, hitung jumlah buku di dalamnya
        $categories = Category::withCount('books')
            ->take(4)
            ->get();

        // Kirim data ke view 'jelajah'
        return view('jelajah', compact('categories'));
    }
}