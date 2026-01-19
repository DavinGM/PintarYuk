@extends('layouts.app')

@section('content')
    <div class="bg-[#020617] min-h-screen pt-32 pb-20 relative overflow-hidden selection:bg-blue-500 selection:text-white">

        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-blue-600/20 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-[10%] right-[-5%] w-[500px] h-[500px] bg-cyan-600/10 blur-[150px] rounded-full"></div>

        <div class="max-w-[1400px] mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-12 gap-8">

                {{-- LEFT: IMAGE SHOWCASE --}}
                <div class="lg:col-span-5" id="hero-image">
                    <div class="sticky top-32 group">
                        <div
                            class="relative bg-slate-900/50 rounded-[3rem] p-12 border border-white/5 backdrop-blur-sm overflow-hidden flex justify-center items-center aspect-[4/5]">

                            @php
                                $coverPath = $book->cover;
                                $isExternalCover = filter_var($coverPath, FILTER_VALIDATE_URL);
                                $finalCoverUrl = $isExternalCover ? $coverPath : asset('storage/' . $coverPath);
                            @endphp

                            <img src="{{ $finalCoverUrl }}" alt="{{ $book->title }}"
                                class="w-[80%] shadow-[0_50px_80px_-20px_rgba(0,0,0,0.5)] rounded-lg transform transition-all duration-700 group-hover:scale-105 group-hover:-rotate-2">

                            @if($book->is_on_sale && $book->discount_percentage > 0)
                                <div
                                    class="absolute top-10 left-10 bg-blue-600 text-white px-6 py-2 rounded-full font-black text-sm tracking-tighter shadow-xl">
                                    Diskon {{ $book->discount_percentage }}%
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT: CONTENT GRID --}}
                <div class="lg:col-span-7 flex flex-col gap-6" id="hero-content">

                    <div class="p-10 rounded-[3rem] bg-white/[0.03] border border-white/10 backdrop-blur-xl">
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="px-4 py-1.5 bg-blue-500/10 border border-blue-500/20 rounded-full text-blue-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                {{ $book->category->name }}
                            </span>
                            <div class="h-px flex-1 bg-gradient-to-r from-white/10 to-transparent"></div>
                        </div>

                        <h1 class="text-6xl md:text-7xl font-black text-white leading-none tracking-tighter mb-6 uppercase">
                            {{ $book->title }}
                        </h1>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-400 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr($book->author, 0, 1) }}
                            </div>
                            <p class="text-slate-400 uppercase text-[11px] tracking-widest font-bold">
                                By <span class="text-white">{{ $book->author }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div
                            class="p-10 rounded-[3rem] bg-blue-600 text-white flex flex-col justify-between relative overflow-hidden group">
                            <div class="relative z-10">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-blue-100 text-xs font-bold uppercase tracking-widest"># harga</span>
                                    @if($book->is_on_sale)
                                        <span
                                            class="text-[10px] bg-white/20 px-2 py-0.5 rounded uppercase font-bold text-white">Promo</span>
                                    @endif
                                </div>

                                <div class="text-5xl font-black tracking-tighter leading-none mb-2">
                                    Rp {{ number_format($book->final_price, 0, ',', '.') }}
                                </div>

                                @if($book->is_on_sale)
                                    <div class="text-blue-200 line-through text-lg font-medium opacity-80">
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-8 relative z-10 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                                <span class="text-xs font-bold uppercase tracking-widest text-blue-100">Stock:
                                    {{ $book->stock }} Tersedia</span>
                            </div>

                            <div class="absolute -bottom-6 -right-6 text-white/10 text-9xl font-black rotate-12">#</div>
                        </div>

                        <div class="flex flex-col gap-4">
                            <button
                                class="add-to-cart-btn flex-1 bg-white hover:bg-cyan-400 transition-all duration-500 rounded-[2.5rem] flex items-center justify-center gap-4 group active:scale-95 shadow-lg shadow-blue-500/10"
                                data-book-id="{{ $book->id }}">
                                <span class="text-black font-black uppercase tracking-tighter text-xl text-btn">tambah ke
                                    keranjang</span>
                                <div class="icon-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-black group-hover:translate-x-2 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </button>

                            <button class="bookmark-btn h-20 bg-white/5 border border-white/10 rounded-[2rem]
                                        transition-all flex items-center justify-center gap-3
                                        text-white font-bold text-sm uppercase tracking-widest
                                        active:scale-95" data-book-id="{{ $book->id }}"
                                data-bookmarked="{{ auth()->check() && $book->bookmarks()->where('user_id', auth()->id())->exists() ? '1' : '0' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-all" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>

                                <span class="label">Save for later</span>
                            </button>

                        </div>
                    </div>

                    <div class="p-10 rounded-[3rem] bg-white/[0.02] border border-white/5 relative group overflow-hidden">
                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="text-white font-black uppercase tracking-widest text-xs">Sinopsis</h3>
                            <div class="h-[1px] flex-1 bg-white/5"></div>
                        </div>
                        <p class="text-slate-400 leading-relaxed text-lg font-light italic">
                            "{{ $book->description ?? 'No narrative provided for this collection.' }}"
                        </p>

                        <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-20 transition-opacity">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                                <path
                                    d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V3L14.017 3C11.8079 3 10.017 4.79086 10.017 7V17C10.017 19.2091 11.8079 21 14.017 21Z">
                                </path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        /* ================================
           BOOKMARK BUTTON – FINAL VERSION
           ================================ */

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.bookmark-btn').forEach(btn => {
                const isActive = btn.dataset.bookmarked === '1';
                setBookmarkStyle(btn, isActive);
            });
        });

        document.addEventListener('click', async (event) => {
            const btn = event.target.closest('.bookmark-btn');
            if (!btn) return;

            const bookId = btn.dataset.bookId;
            const isActive = btn.dataset.bookmarked === '1';

            try {
                const response = await fetch('/bookmark/toggle', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        book_id: bookId
                    })
                });

                if (!response.ok) {
                    throw new Error('Server error');
                }

                // toggle state
                const newState = !isActive;
                btn.dataset.bookmarked = newState ? '1' : '0';
                setBookmarkStyle(btn, newState);

            } catch (error) {
                console.error(error);
                alert('Berhasil di Proses');

                // Ini akan menjalankan refresh setelah user klik OK pada alert
                window.location.reload();
            }
        });

        /* ================================
           CART LOGIC (ADD TO CART)
           ================================ */
        document.querySelector('.add-to-cart-btn')?.addEventListener('click', async function () {
            const btn = this;
            const bookId = btn.dataset.bookId;
            const textSpan = btn.querySelector('.text-btn');
            const iconDiv = btn.querySelector('.icon-btn');
            const originalText = textSpan.innerText;
            const originalIcon = iconDiv.innerHTML;

            // Loading State
            btn.disabled = true;
            textSpan.innerText = 'Memproses...';
            iconDiv.innerHTML = '<svg class="w-6 h-6 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

            try {
                const response = await fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ book_id: bookId, qty: 1 })
                });

                const data = await response.json();

                if (data.status === 'success') {
                    // Success State
                    btn.classList.replace('bg-white', 'bg-green-500');
                    btn.classList.replace('hover:bg-cyan-400', 'hover:bg-green-600');
                    textSpan.innerText = 'Berhasil!';
                    textSpan.classList.add('text-white');
                    textSpan.classList.remove('text-black');

                    iconDiv.innerHTML = '<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';

                    setTimeout(() => {
                        location.href = "{{ route('cart.index') }}";
                    }, 800);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menambahkan ke keranjang');
                // Reset State
                btn.disabled = false;
                textSpan.innerText = originalText;
                iconDiv.innerHTML = originalIcon;
                textSpan.classList.remove('text-white');
                textSpan.classList.add('text-black');
            }
        });
        function setBookmarkStyle(btn, active) {
            // DETAIL PAGE (button tinggi h-20)
            if (btn.classList.contains('h-20')) {
                btn.style.backgroundColor = active ? '#2563eb' : 'rgba(255,255,255,0.05)';
                btn.style.borderColor = active ? '#2563eb' : 'rgba(255,255,255,0.1)';
                btn.style.color = '#ffffff';

                const label = btn.querySelector('.label');
                if (label) {
                    label.textContent = active ? 'Saved' : 'Save for later';
                }

                const icon = btn.querySelector('svg');
                if (icon) {
                    icon.style.color = '#ffffff';
                }

                return;
            }

            // GRID / CARD (kalau nanti dipakai)
            btn.style.backgroundColor = active ? '#facc15' : 'transparent';
            btn.style.color = active ? '#020617' : '#94a3b8';
        }
    </script>




    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
@endsection