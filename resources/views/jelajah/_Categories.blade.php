<section id="categories-section" class="py-16">
    <div class="flex justify-between items-end mb-10">
        <div>
            <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">Explore by Interest</span>
            <h2 class="text-white text-3xl font-bold mt-2">Kategori Pilihan</h2>
        </div>
        
        <a href="/categories" class="group flex items-center gap-3 text-slate-400 hover:text-white transition-all font-bold">
            Lihat Semua Kategori
            <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-blue-600 group-hover:border-blue-600 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </div>
        </a>
    </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($categories as $cat)
                    {{-- Card Kategori --}}
                    {{-- Kita bungkus seluruh kartu dengan tag <a> agar bisa diklik --}}
                    <a href="{{ route('category.show', $cat->slug) }}" class="category-card group relative p-8 rounded-[2rem] bg-slate-900/50 border border-white/5 hover:border-blue-500/30 overflow-hidden transition-colors duration-500 block">
                        
                        {{-- Background Gradient Dinamis dari Kolom 'color' --}}
                        {{-- Pastikan data di database berupa class Tailwind, misal: from-blue-600/20 --}}
                        <div class="absolute inset-0 bg-gradient-to-br {{ $cat->color }} to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative z-10">
                            {{-- Icon Dinamis --}}
                            <div class="text-5xl mb-6 transform group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500">
                                {{ $cat->icon }}
                            </div>

                            {{-- Nama Kategori Dinamis --}}
                            <h3 class="text-white text-xl font-bold leading-tight">
                                {{ $cat->name }}
                            </h3>

                            {{-- Jumlah Buku Dinamis --}}
                            <p class="text-slate-500 text-sm mt-2 font-medium">
                                {{ number_format($cat->books_count) }}+ Buku
                            </p>
                        </div>

                        {{-- Icon Panah --}}
                        <div class="absolute bottom-8 right-8 opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </a>
                @empty
                    {{-- Kondisi jika database kosong --}}
                    <div class="col-span-full text-center p-10 bg-slate-900/50 rounded-[2rem] border border-dashed border-white/10">
                        <p class="text-slate-400 italic">Belum ada kategori tersedia.</p>
                    </div>
                @endforelse
                </div>


</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap !== 'undefined') {
            // Animasi Reveal saat scroll
            gsap.from(".category-card", {
                scrollTrigger: {
                    trigger: "#categories-section",
                    start: "top 80%",
                },
                y: 40,
                opacity: 0,
                stagger: 0.1,
                duration: 1,
                ease: "expo.out"
            });

            // Efek Tilt Magnetik (Sederhana tapi keren)
            const cards = document.querySelectorAll('.category-card');
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;

                    gsap.to(card, {
                        rotateX: rotateX,
                        rotateY: rotateY,
                        scale: 1.02,
                        duration: 0.5,
                        ease: "power2.out",
                        perspective: 1000
                    });
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        rotateX: 0,
                        rotateY: 0,
                        scale: 1,
                        duration: 0.5,
                        ease: "mouse.out"
                    });
                });
            });
        }
    });
</script>
@endpush