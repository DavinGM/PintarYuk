@extends('layouts.app')

@section('content')
    <div id="bookmark-page" class="bg-slate-950 min-h-screen pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-white text-3xl font-black uppercase tracking-tight">Koleksi <span
                            class="text-blue-500">Bookmark</span></h1>
                    <p class="text-slate-400 text-sm mt-1">Buku yang kamu simpan untuk dibaca nanti.</p>
                </div>
                <div class="bg-slate-900 border border-white/5 px-4 py-2 rounded-xl text-white text-sm font-bold">
                    Total: {{ $bookmarks->count() }}
                </div>
            </div>

            @if($bookmarks->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-20 border-2 border-dashed border-white/5 rounded-[3rem] bg-slate-900/10">
                    <div
                        class="w-20 h-20 bg-slate-900 border border-white/5 rounded-2xl flex items-center justify-center mb-6 shadow-xl">
                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-white text-xl font-bold mb-2">Belum ada bookmark</h3>
                    <p class="text-slate-500 mb-6">Kamu belum menyimpan buku apapun.</p>
                    <a href="{{ route('jelajah') }}"
                        class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl font-bold transition-all transform hover:scale-105">
                        Jelajah Buku
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($bookmarks as $bookmark)
                        @php $book = $bookmark->book; @endphp
                        @if($book)
                            <div
                                class="group relative bg-slate-900/40 border border-white/5 rounded-[2rem] p-4 transition-all hover:bg-slate-900/80 hover:border-blue-500/30 hover:-translate-y-1 bookmark-item-{{ $book->id }}">

                                {{-- Remove Button --}}
                                <button
                                    class="bookmark-btn absolute top-6 right-6 z-30 w-10 h-10 bg-white text-blue-500 rounded-xl flex items-center justify-center transition-all hover:scale-110 shadow-lg active:scale-95"
                                    data-book-id="{{ $book->id }}" title="Hapus dari bookmark">
                                    <svg class="w-5 h-5 pointer-events-none" fill="currentColor" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                </button>

                                {{-- Cover --}}
                                <div class="relative h-[280px] w-full rounded-[1.5rem] overflow-hidden bg-slate-800 shadow-md mb-5">
                                    <img src="{{ $book->cover }}" alt="{{ $book->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </div>

                                {{-- Info --}}
                                <div class="px-2 pb-2">
                                    <p class="text-blue-500 text-[10px] font-black uppercase tracking-widest mb-1">{{ $book->author }}
                                    </p>
                                    <h3 class="text-white font-bold text-lg leading-tight truncate">{{ $book->title }}</h3>
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="text-white font-black">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                                        <a href="{{ route('book.show', $book->slug) }}"
                                            class="text-slate-400 hover:text-white text-sm transition-colors">
                                            Detail &rarr;
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.bookmark-btn').forEach(btn => {
                btn.addEventListener('click', async function () {
                    const bookId = this.dataset.bookId;
                    const card = document.querySelector(`.bookmark-item-${bookId}`);

                    // Optimistic UI Removal
                    if (card) {
                        // Animate out
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        setTimeout(() => card.remove(), 500);
                    }

                    try {
                        const response = await fetch("{{ route('bookmark.toggle') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ book_id: bookId })
                        });

                        const data = await response.json();

                        if (data.status === 'added') {
                            // Shouldn't happen in bookmark page normally, but just in case
                            console.log('Bookmarked');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        // Revert if error (optional, complex to revert removal animation purely)
                        alert('Gagal menghapus bookmark, silakan coba lagi.');
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush