<section id="showcase-wrapper" class="relative bg-slate-950 overflow-hidden">
    <div id="pin-section" class="h-screen flex items-center relative">
        
        <div id="horizontal-track" class="flex items-center gap-16 md:gap-32 px-[10vw] min-w-max pt-20">
            
            <div class="story-card w-[450px] md:w-[700px] perspective-1000">
                <h2 class="story-title text-7xl md:text-9xl font-black text-white leading-[0.85] tracking-tighter">
                    KARYA <br> <span class="text-indigo-500">UNGGUL.</span>
                </h2>
                <div class="h-1 w-24 bg-indigo-500 my-8"></div>
                <p class="text-slate-400 text-xl md:text-2xl max-w-md font-light leading-relaxed">
                    "Lembaran yang tidak hanya dibaca, tapi <span class="text-white font-bold">dirasakan</span>. Kurasi terbaik untuk masa depanmu."
                </p>
            </div>

            @php
                $books = [
                    ['title' => 'Mencari Makna', 'cat' => 'Philosophy', 'img' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80', 'color' => 'indigo'],
                    ['title' => 'Atomic Habits', 'cat' => 'Self Dev', 'img' => 'https://images.unsplash.com/photo-1589998059171-d88d367e8931?auto=format&fit=crop&q=80', 'color' => 'emerald'],
                    ['title' => 'Hujan Jendela', 'cat' => 'Literature', 'img' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80', 'color' => 'purple'],
                ];
            @endphp

            @foreach($books as $book)
            <div class="book-card relative group w-[320px] md:w-[500px]">
                <div class="book-container relative aspect-[3/4] rounded-[2rem] overflow-hidden border border-white/5 bg-slate-900 shadow-2xl transition-all duration-700 group-hover:border-{{ $book['color'] }}-500/50">
                    <img src="{{ $book['img'] }}" class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-1000 ease-out grayscale group-hover:grayscale-0">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-90"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-{{ $book['color'] }}-400 font-black text-xs uppercase tracking-[0.3em] mb-2 block">{{ $book['cat'] }}</span>
                        <h3 class="text-3xl md:text-4xl font-black text-white leading-none">{{ $book['title'] }}</h3>
                    </div>
                </div>
                <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-4/5 h-4 bg-{{ $book['color'] }}-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            @endforeach

            <div class="story-card w-[450px] md:w-[700px] flex flex-col items-start">
                <h2 class="text-6xl md:text-8xl font-black text-white leading-none mb-10">
                    SIAP <br> BELAJAR?
                </h2>
                <a href="/jelajah" class="group relative px-12 py-6 bg-indigo-600 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 bg-white translate-y-[101%] group-hover:translate-y-0 transition-transform duration-500"></div>
                    <span class="relative z-10 text-white group-hover:text-slate-950 font-black text-xl uppercase tracking-widest transition-colors">Jelajahi Sekarang</span>
                </a>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        const initShowcase = () => {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                const track = document.getElementById('horizontal-track');
                const wrapper = document.getElementById('showcase-wrapper');
                
                // 1. Horizontal Scroll Pinning
                const scrollWidth = track.scrollWidth;
                const scrollAmount = -(scrollWidth - window.innerWidth);

                const tween = gsap.to(track, {
                    x: scrollAmount,
                    ease: "none", // Harus none untuk scrub agar halus
                    scrollTrigger: {
                        trigger: wrapper,
                        start: "top top",
                        end: () => `+=${scrollWidth}`,
                        pin: true,
                        scrub: 1, // Durasi follow scroll
                        invalidateOnRefresh: true,
                    }
                });

                // 2. Efek Parallax untuk Tulisan Judul (Story Title)
                gsap.to(".story-title", {
                    x: 100, // Teks judul bergerak lebih lambat ke kanan
                    scrollTrigger: {
                        trigger: ".story-title",
                        containerAnimation: tween,
                        start: "left center",
                        scrub: true
                    }
                });

                // 3. Efek "Buku Terbuka" (Skew & Scale)
                gsap.utils.toArray(".book-card").forEach((card, i) => {
                    gsap.from(card.querySelector('.book-container'), {
                        rotateY: -30,
                        rotateX: 10,
                        skewX: -5,
                        scale: 0.8,
                        opacity: 0,
                        transformOrigin: "left center",
                        scrollTrigger: {
                            trigger: card,
                            containerAnimation: tween, // Sinkron dengan scroll horizontal
                            start: "left 90%",
                            end: "left 40%",
                            scrub: true,
                        }
                    });
                });

                // 4. Perbaikan Gap Navbar Otomatis
                // Jika navbar tingginya berubah, padding akan menyesuaikan
                const navHeight = document.getElementById('main-nav').offsetHeight;
                track.style.paddingTop = `${navHeight + 20}px`;
            }
        };

        window.addEventListener('load', initShowcase);
    })();
</script>
@endpush