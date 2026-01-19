<section id="banner-section" class="py-20 bg-slate-950">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="banner-card relative h-[500px] md:h-[600px] rounded-[3rem] bg-[#1a1a1a] border border-white/5 overflow-hidden group">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&q=80" 
                         class="w-full h-full object-cover opacity-40 group-hover:scale-105 transition-transform duration-1000">
                </div>
                
                <div class="relative z-10 p-12 h-full flex flex-col justify-between">
                    <div>
                        <h2 class="text-5xl md:text-6xl font-black text-white leading-none tracking-tighter">
                            UPGRADE <br> <span class="text-blue-500">YOUR BRAIN.</span>
                        </h2>
                        <p class="mt-6 text-slate-400 text-lg max-w-xs font-medium leading-relaxed">
                            Akses koleksi buku sains internasional dengan harga lokal. Hanya bulan ini.
                        </p>
                    </div>

                    <a href="#" class="flex items-center gap-4 group/btn">
                        <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center text-white group-hover/btn:bg-white group-hover/btn:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                        <span class="text-white font-bold tracking-widest uppercase text-sm">Lihat Katalog</span>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                
                <div class="banner-card relative flex-1 rounded-[3rem] bg-gradient-to-br from-indigo-600 to-violet-700 p-12 overflow-hidden group">
                    <div class="relative z-10">
                        <span class="text-xs font-black tracking-[0.3em] uppercase text-white/60">Limited Offer</span>
                        <h3 class="text-4xl font-black text-white mt-4">Bundling <br> Hemat 40%</h3>
                        <p class="text-indigo-100 mt-4 max-w-[200px]">Paket lengkap untuk persiapan masuk PTN.</p>
                    </div>
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
                </div>

                <div class="banner-card relative flex-1 rounded-[3rem] bg-slate-900 border border-white/5 p-12 overflow-hidden group">
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex justify-between items-start">
                            <h3 class="text-3xl font-black text-white uppercase leading-none">Weekly <br> Update</h3>
                            <div class="text-blue-500">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                        </div>
                        <div class="flex items-end justify-between">
                            <p class="text-slate-500 font-bold italic">+250 Judul Baru</p>
                            <span class="text-white text-xs font-black underline tracking-widest cursor-pointer">CEK SEKARANG</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        const initBanner = () => {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Animasi Reveal Per Card
                gsap.utils.toArray(".banner-card").forEach((card) => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 85%",
                            toggleActions: "play none none reverse",
                        },
                        y: 50,
                        opacity: 0,
                        duration: 1.5,
                        ease: "expo.out" // Efek transisi yang sangat halus (premium)
                    });
                });

                // Parallax subtle pada background image di card utama
                gsap.to(".banner-card img", {
                    scrollTrigger: {
                        trigger: "#banner-section",
                        scrub: true,
                    },
                    y: -50,
                    ease: "none"
                });
            }
        };

        window.addEventListener('load', initBanner);
    })();
</script>
@endpush