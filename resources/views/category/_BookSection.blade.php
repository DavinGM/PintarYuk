<section class="mt-32">
    @foreach($categories as $category)
        <div class="mb-24 reveal-up">

            {{-- Header Category --}}
            <div class="flex items-end justify-between mb-10 border-b border-white/5 pb-6">
                <h2 class="text-2xl font-black text-white uppercase italic tracking-tighter">
                    {{ $category['name'] }}
                </h2>

                <a href="{{ route('category.show', $category['slug']) }}"
                   class="text-blue-500 text-[10px] font-black uppercase tracking-widest hover:text-white transition-colors">
                    View All
                </a>
            </div>

            {{-- Book Grid --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-12">
    @foreach($category['books'] as $book)
        <div class="group cursor-pointer">
            
            {{-- Bagian Gambar --}}
            <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] bg-slate-900 border border-white/5">
                @php
                    $imagePath = $book['image'];
                    $isExternal = filter_var($imagePath, FILTER_VALIDATE_URL);
                    $finalUrl = $isExternal ? $imagePath : asset('storage/' . $imagePath);
                @endphp

                <img
                    src="{{ $finalUrl }}"
                    alt="{{ $book['title'] }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100"
                    onerror="this.src='https://placehold.co/400x600/020617/white?text=No+Image'"
                >
                
                {{-- Overlay Detail Button --}}
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex items-end">
                    @if(!empty($book['slug']))
                        <a href="{{ route('book.show', $book['slug']) }}"
                           class="w-full py-3 bg-white text-black font-black text-[10px] uppercase rounded-xl text-center">
                            Detail
                        </a>
                    @endif
                </div>
            </div>

            {{-- Bagian Informasi Buku --}}
            <div class="mt-4">
                <h3 class="text-white font-bold text-sm line-clamp-1">
                    {{ $book['title'] }}
                </h3>

                <p class="text-slate-500 text-[10px] font-bold uppercase mt-1">
                    {{ $book['author'] }}
                </p>

                {{-- Baris Harga & Bookmark --}}
                <div class="flex items-center justify-between mt-3">
                    <p class="text-blue-500 font-bold text-xs">
                        {{ $book['price'] }} 
                    </p>
                    
                    <button
                        class="bookmark-btn p-2 rounded-lg transition"
                        data-book-id="{{ $book['id'] }}"
                        data-bookmarked="{{ $book['is_bookmarked'] ? '1' : '0' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>

                </div>
            </div>

        </div>
    @endforeach
</div>
            {{-- Pagination Visual (Landing Page – Dummy by Design) --}}
            <div class="mt-12 flex justify-center gap-2">
                <button class="w-8 h-8 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-[10px]">
                    1
                </button>

                @if($category['pagination']['hasNext'])
                    <button class="w-8 h-8 rounded-lg bg-white/5 text-slate-500 flex items-center justify-center hover:bg-slate-800 transition-all font-bold text-[10px]">
                        2
                    </button>

                    <a href="{{ route('category.show', $category['slug']) }}"
                       class="w-12 h-8 rounded-lg bg-white/5 text-slate-400 flex items-center justify-center hover:bg-slate-800 transition-all font-bold text-[10px]">
                        Next
                    </a>
                @endif
            </div>

        </div>
    @endforeach
</section>
