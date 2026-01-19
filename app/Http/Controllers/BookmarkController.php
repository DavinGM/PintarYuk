<?php

namespace App\Http\Controllers;
use App\Models\Bookmark;


use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bookmark.index', compact('bookmarks'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('book_id', $request->book_id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();

            return response()->json([
                'status' => 'removed'
            ]);
        }

        Bookmark::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id
        ]);

        return response()->json([
            'status' => 'added'
        ])->middleware('auth');
    }
}
