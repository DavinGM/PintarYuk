@extends('layouts.app')

@section('content')
<div id="books-page" class="bg-[#020617] min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Hero Header untuk Halaman Books --}}
        <header class="mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">
                Katalog <span class="text-blue-600">Buku</span>
            </h1>
            <p class="text-slate-500 mt-2 font-medium">Temukan koleksi terbaik dari setiap genre yang kami miliki.</p>
        </header>

        {{-- MOCK DATA ARRAY (Nanti hapus ini dan ambil dari Controller) --}}
        @php
            $categories = [
                [
                    'name' => 'Sains & Teknologi',
                    'slug' => 'sains-teknologi',
                    'books' => array_fill(0, 8, [
                        'title' => 'The Theory of Everything',
                        'author' => 'Stephen Hawking',
                        'price' => 'Rp 125.000',
                        'rating' => '4.8',
                        'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=400&auto=format&fit=crop'
                    ])
                ],
                [
                    'name' => 'Filosofi Dunia',
                    'slug' => 'filosofi',
                    'books' => array_fill(0, 8, [
                        'title' => 'Beyond Good and Evil',
                        'author' => 'Friedrich Nietzsche',
                        'price' => 'Rp 98.000',
                        'rating' => '4.9',
                        'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=400&auto=format&fit=crop'
                    ])
                ]
            ];
        @endphp

        {{-- Loop Category Section --}}
        @foreach($categories as $category)
            @include('books._CategorySection', ['category' => $category])
        @endforeach

    </div>
</div>
@endsection