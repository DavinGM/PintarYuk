<section id="product-grid" class="py-16 relative overflow-hidden bg-slate-950">
    {{-- Background Aesthetic --}}
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-blue-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6">
        {{-- 1. Header & UX Hint --}}
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="h-[1px] w-8 bg-blue-500"></span>
                    <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-[10px]">Curated for You</span>
                </div>
                <h2 class="text-white text-4xl font-bold tracking-tight uppercase">Koleksi <span class="text-slate-500 italic font-light">Pintar</span></h2>
            </div>
            
            @if($products->isNotEmpty())
            <div class="hidden md:flex items-center gap-3 bg-white/5 border border-white/10 px-5 py-2.5 rounded-2xl shadow-inner">
                <div class="flex gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400/50"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-300/20"></span>
                </div>
                <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Geser Horizontal (Maks 10/Baris)</span>
            </div>
            @endif
        </div>

        {{-- 2. Main Logic: Forelse untuk Handle Data Kosong --}}
        @forelse($products->chunk(10) as $chunkIndex => $rowProducts)
            <div class="relative group {{ $loop->first ? '' : 'mt-20' }}">
                
                {{-- Row Label --}}
                @if(!$loop->first)
                    <div class="mb-8 flex items-center gap-4">
                        <span class="text-blue-500/40 text-[10px] font-black uppercase tracking-[0.4em]">Baris {{ $loop->iteration }}</span>
                        <div class="h-[1px] flex-grow bg-gradient-to-r from-blue-500/20 to-transparent"></div>
                    </div>
                @endif

                {{-- Navigation Buttons (Desktop) --}}
                <div class="hidden md:block">
                    <button onclick="sideScroll('left', {{ $chunkIndex }})" 
                        class="absolute -left-6 top-1/2 -translate-y-1/2 z-40 w-12 h-12 bg-slate-900/90 border border-white/10 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-blue-600 hover:scale-110 shadow-2xl backdrop-blur-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button onclick="sideScroll('right', {{ $chunkIndex }})" 
                        class="absolute -right-6 top-1/2 -translate-y-1/2 z-40 w-12 h-12 bg-slate-900/90 border border-white/10 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-blue-600 hover:scale-110 shadow-2xl backdrop-blur-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                {{-- Scrollable Container --}}
                <div id="scroll-container-{{ $chunkIndex }}" 
                    class="flex overflow-x-auto gap-7 pb-8 no-scrollbar snap-x snap-mandatory touch-pan-x scroll-smooth">
                    
                    @foreach($rowProducts as $p)
                        <div class="product-card flex-none w-[300px] snap-start group/card relative bg-slate-900/40 border border-white/5 rounded-[2.5rem] p-5 transition-all duration-500 hover:border-blue-500/30 hover:bg-slate-900/80">
                            
                            {{-- Bookmark --}}
                            <button class="bookmark-btn absolute top-8 right-8 z-30 w-11 h-11 bg-slate-950/60 backdrop-blur-md border border-white/10 rounded-2xl flex items-center justify-center text-white transition-all hover:scale-110 active:scale-95">
                                <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </button>

                            {{-- Image Section --}}
                            <div class="relative h-[320px] w-full rounded-[2rem] overflow-hidden bg-slate-800 shadow-inner">
                                <img src="{{ $p->cover }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover/card:scale-110" loading="lazy">
                                
                                @if($p->stock <= 0)
                                    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-[3px] flex items-center justify-center">
                                        <span class="text-white font-black uppercase text-[10px] tracking-[0.2em] border border-white/20 px-5 py-2 rounded-full">Sold Out</span>
                                    </div>
                                @endif

                                @if($p->is_on_sale && $p->discount_percentage > 0)
                                    <div class="absolute bottom-5 left-5 bg-rose-600 text-white text-[10px] font-black px-3.5 py-1.5 rounded-xl uppercase tracking-tighter shadow-lg shadow-rose-600/40">
                                        Save {{ $p->discount_percentage }}%
                                    </div>
                                @endif
                            </div>

                            {{-- Product Info --}}
                            <div class="mt-6 px-1">
                                <p class="text-blue-500 text-[10px] font-black uppercase tracking-widest leading-none">{{ $p->author }}</p>
                                <h3 class="text-white text-xl font-extrabold truncate mt-2">{{ $p->title }}</h3>
                                
                                {{-- Price Container (Anti-Isrob) --}}
                                <div class="mt-4 flex flex-wrap items-center gap-3 h-8">
                                    @if($p->is_on_sale && $p->discount_percentage > 0)
                                        <span class="text-white font-black text-2xl tracking-tighter">Rp{{ number_format($p->final_price, 0, ',', '.') }}</span>
                                        <span class="text-slate-500 text-xs line-through opacity-50">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-white font-black text-2xl tracking-tighter">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                {{-- Footer --}}
                                <div class="flex items-center justify-between mt-6 pt-5 border-t border-white/5">
                                    <div class="flex items-center gap-2">
                                        <div class="text-amber-400">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        </div>
                                        <span class="text-slate-400 text-[11px] font-bold">4.9 | {{ $p->sold_count ?? 0 }} Terjual</span>
                                    </div>
                                    <button class="add-to-cart-btn w-11 h-11 bg-white text-slate-950 rounded-2xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-90 group-hover/card:shadow-blue-600/20"
                                        data-book-id="{{ $p->id }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        @empty
            {{-- 3. Empty State (Produk Tidak Ada) --}}
            <div class="flex flex-col items-center justify-center py-32 border-2 border-dashed border-white/5 rounded-[3.5rem] bg-slate-900/10">
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-blue-500/10 blur-[60px] rounded-full"></div>
                    <div class="w-24 h-24 bg-slate-900 border border-white/5 rounded-3xl flex items-center justify-center relative z-10 shadow-2xl">
                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-white text-2xl font-black uppercase tracking-tight mb-3">Produk tidak ada 288</h3>
                <p class="text-slate-500 text-sm max-w-xs text-center leading-relaxed font-medium">
                    Wah, koleksinya lagi kosong nih. Coba cek beberapa saat lagi ya!
                </p>
            </div>
        @endforelse
    </div>
</section>

<style>
    /* Clean Hide Scrollbar */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* GSAP reveal prep */
    .product-card {
        opacity: 0;
        transform: translateY(40px);
    }
</style>

@push('scripts')
<script>
    /**
     * Side Scroll Navigation Logic
     */
    function sideScroll(direction, index) {
        const container = document.getElementById('scroll-container-' + index);
        const scrollAmount = 340; 
        if (container) {
            container.scrollBy({
                left: direction === 'left' ? -scrollAmount : scrollAmount,
                behavior: 'smooth'
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        /**
         * GSAP Reveal Animation
         */
        if (window.gsap && window.ScrollTrigger) {
            gsap.to(".product-card", {
                opacity: 1,
                y: 0,
                stagger: {
                    amount: 0.5,
                    from: "start"
                },
                duration: 1.2,
                ease: "expo.out",
                scrollTrigger: {
                    trigger: "#product-grid",
                    start: "top 85%",
                    toggleActions: "play none none none"
                }
            });
        }

        /**
         * Bookmark Toggle Interaction
         */
        document.querySelectorAll('.bookmark-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const svg = this.querySelector('svg');
                const isSaved = svg.getAttribute('fill') === 'currentColor';
                
                if (isSaved) {
                    svg.setAttribute('fill', 'none');
                    this.classList.replace('text-blue-500', 'text-white');
                    this.classList.replace('bg-white', 'bg-slate-950/60');
                } else {
                    svg.setAttribute('fill', 'currentColor');
                    this.classList.replace('text-white', 'text-blue-500');
                    this.classList.replace('bg-slate-950/60', 'bg-white');
                    
                    // Micro-interaction pop
                    if (window.gsap) {
                        gsap.fromTo(this, { scale: 0.8 }, { scale: 1, duration: 0.4, ease: "back.out(3)" });
                    }
                }
            });
        });

        /**
         * Add to Cart Logic
         */
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent card click
                
                const bookId = this.dataset.bookId;
                const originalContent = this.innerHTML;

                // Loading State
                this.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                this.disabled = true;

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
                        this.classList.replace('bg-white', 'bg-green-500');
                        this.classList.replace('text-slate-950', 'text-white');
                        this.classList.replace('hover:bg-blue-600', 'hover:bg-green-600');
                        this.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                        
                        // Update Navbar Counter (Optional reload or event dispatch)
                        // For now we just animate button
                        
                        setTimeout(() => {
                             // Reset after 2s
                            this.innerHTML = originalContent;
                            this.classList.replace('bg-green-500', 'bg-white');
                            this.classList.replace('text-white', 'text-slate-950');
                            this.classList.replace('hover:bg-green-600', 'hover:bg-blue-600');
                            this.disabled = false;
                        }, 2000);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.innerHTML = originalContent;
                    this.disabled = false;
                    alert('Gagal menambahkan ke keranjang.');
                }
            });
        });
    });
</script>
@endpush