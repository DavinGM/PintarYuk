@extends('layouts.app')

@section('content')
<div class="bg-[#020617] min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 text-center mb-20">
        <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">Search Results</span>
        <h1 class="text-white text-5xl font-black mt-4 uppercase italic">
            Found {{ $books->total() }} results for "<span class="text-blue-500">{{ $query }}</span>"
        </h1>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-14">
            @forelse($books as $book)
                {{-- Gunakan Bento Grid Book Card yang sudah kita buat sebelumnya di sini --}}
                @include('partials._book_card', ['book' => $book])
            @empty
                <div class="col-span-full py-20 text-center bg-white/5 rounded-[3rem] border border-dashed border-white/10">
                    <p class="text-slate-500 italic">No matches found for your criteria.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $books->appends(['q' => $query])->links() }}
        </div>
    </div>
</div>
@endsection