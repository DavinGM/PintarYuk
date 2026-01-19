@extends('layouts.app')

@section('content')
<div class="bg-[#020617] min-h-screen pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Category Title --}}
        <div class="mb-16">
            <h1 class="text-3xl font-black text-white uppercase italic tracking-tight">
                {{ $category->name }}
            </h1>
        </div>

        {{-- Books Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-14">
            @foreach($books as $book)
    <div class="group cursor-pointer">
        <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] bg-slate-900 border border-white/5">
            
            {{-- 1. Logika Percabangan Gambar --}}
            @php
                $isExternal = filter_var($book->cover, FILTER_VALIDATE_URL);
                $finalUrl = $isExternal ? $book->cover : asset('storage/' . $book->cover);
            @endphp

            <img
                src="{{ $finalUrl }}"
                alt="{{ $book->title }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90"
            >

            {{-- 2. Ubah Button menjadi Link (<a>) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex items-end">
                <a href="{{ route('book.show', $book->slug) }}" 
                   class="w-full py-3 bg-white text-black font-black text-[10px] uppercase rounded-xl text-center hover:bg-blue-500 hover:text-white transition-colors duration-300">
                    Detail
                </a>
            </div>
        </div>

        {{-- Info Buku --}}
        <div class="mt-4">
            <h3 class="text-white font-bold text-sm line-clamp-1">
                {{ $book->title }}
            </h3>
            <p class="text-slate-500 text-[10px] font-bold uppercase mt-1">
                {{ $book->author }}
            </p>
            <p class="text-blue-500 font-bold text-xs mt-3">
                Rp {{ number_format($book->final_price, 0, ',', '.') }}
            </p>
        </div>
    </div>
@endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-16">
            {{ $books->links('pagination::tailwind') }}
        </div>

    </div>
</div>
@endsection
