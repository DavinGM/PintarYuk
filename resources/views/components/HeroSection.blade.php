<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-24 pb-12 bg-slate-950 text-white">
    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-blue-600/20 rounded-full blur-[120px]" id="blob-1"></div>
    <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-purple-600/20 rounded-full blur-[120px]" id="blob-2"></div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div class="text-center lg:text-left">
            <div id="hero-tag" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-black uppercase tracking-[0.2em] mb-8">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Koleksi Terbaru 2025
            </div>

            <h1 id="hero-title" class="text-5xl md:text-7xl xl:text-8xl font-black leading-[1.05] mb-8 tracking-tighter">
                Investasi Terbaik <br> Adalah <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-emerald-400">Ilmu.</span>
            </h1>

            <p id="hero-desc" class="text-slate-400 text-lg md:text-xl mb-12 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                {{ $description ?? 'Temukan ribuan referensi buku belajar terlengkap untuk mendukung masa depan cemerlang Anda.' }}
            </p>

            <div id="hero-btns" class="flex flex-wrap justify-center lg:justify-start items-center gap-5">
                <a href="/jelajah" id="btn-glow" class="relative group px-10 py-5 bg-indigo-600 text-slate-950 rounded-2xl font-extrabold transition-all overflow-hidden active:scale-95 shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                    <span id="shine-effect" class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/80 to-transparent -translate-x-full"></span>
                    <span class="relative z-10 flex items-center gap-2">
                        JELAJAHI BUKU
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
                <a href="/category" class="px-10 py-5 rounded-2xl font-extrabold border-2 border-slate-800 text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    Kategori
                </a>
            </div>
        </div>

        <div class="relative" id="hero-visual">
            <div class="relative w-full max-w-lg mx-auto aspect-square bg-gradient-to-tr from-blue-600 to-purple-600 rounded-[4rem] rotate-6 overflow-hidden shadow-2xl group">
                <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80" class="w-full h-full object-cover mix-blend-overlay opacity-40">
                <div class="absolute inset-0 flex items-center justify-center text-[10rem]">📚</div>
            </div>
            <div id="hero-card" class="absolute -bottom-8 -left-8 bg-slate-900/90 backdrop-blur-xl p-8 rounded-[2rem] border border-white/10 shadow-2xl">
                <p class="text-[10px] text-blue-400 font-black uppercase tracking-widest mb-2">Library Update</p>
                <p class="text-3xl font-black">15,000+</p>
                <p class="text-xs text-slate-500 font-bold">Buku Terverifikasi</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        const initHeroAnimation = () => {
            if (typeof gsap !== 'undefined') {
                const tl = gsap.timeline({ defaults: { ease: "power4.out", duration: 1.5 } });
                tl.from("#hero-visual", { scale: 0.8, opacity: 0, rotate: 0 }, 0.5)
                  .from("#hero-tag", { y: 20, opacity: 0 }, "-=1.2")
                  .from("#hero-title", { y: 40, opacity: 0 }, "-=1.3")
                  .from("#hero-desc", { y: 20, opacity: 0 }, "-=1.3")
                  .from("#hero-btns", { y: 20, opacity: 0 }, "-=1.3")
                  .from("#hero-card", { x: -30, opacity: 0 }, "-=1.1");

                gsap.to("#blob-1", { y: 40, x: 20, duration: 10, repeat: -1, yoyo: true, ease: "sine.inOut" });
                gsap.to("#blob-2", { y: -40, x: -20, duration: 8, repeat: -1, yoyo: true, ease: "sine.inOut" });
                gsap.to("#btn-glow", {
                    scale: 1.05,
                    boxShadow: "0 0 30px 5px rgba(255, 255, 255, 0.4)",
                    duration: 1.2,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
                gsap.to("#shine-effect", {
                    x: "250%",
                    duration: 2,
                    repeat: -1,
                    repeatDelay: 1,
                    ease: "power2.inOut"
                });
            }
        };

        // Menjalankan animasi setelah DOM siap
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHeroAnimation);
        } else {
            initHeroAnimation();
        }
    })();
</script>
@endpush