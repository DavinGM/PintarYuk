<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-auto lg:h-[450px]">
    <div class="lg:col-span-8 relative rounded-[2.5rem] overflow-hidden border border-white/5 shadow-2xl shadow-blue-500/5 group">
        <div class="swiper mySwiper h-full w-full bg-slate-900">
            <div class="swiper-wrapper">
                {{-- Slide 1 --}}
                <div class="swiper-slide relative">
                    <a href="/promo-sains">
                        <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80" 
                            class="w-full h-full object-cover" alt="Festival Sains">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    </a>
                </div>

                {{-- Slide 2 --}}
                <div class="swiper-slide relative">
                    <a href="/promo-novel">
                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&q=80" 
                            class="w-full h-full object-cover" alt="Promo Novel">
                    </a>
                </div>

                {{-- Slide 3 --}}
                <div class="swiper-slide relative">
                    <a href="/promo-back-to-school">
                        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80" 
                            class="w-full h-full object-cover" alt="Back to School">
                    </a>
                </div>
            </div>

            {{-- Navigation --}}
            <div class="swiper-button-next !text-white !w-10 !h-10 bg-black/20 backdrop-blur-md rounded-full after:!text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 mr-4"></div>
            <div class="swiper-button-prev !text-white !w-10 !h-10 bg-black/20 backdrop-blur-md rounded-full after:!text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ml-4"></div>
            <div class="swiper-pagination !bottom-8"></div>
        </div>
    </div>

    <div class="lg:col-span-4 grid grid-rows-2 gap-6 h-full">
        {{-- Flash Sale --}}
        <div class="relative rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-indigo-600 to-purple-700 p-8 group border border-white/10">
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-black text-white leading-tight">Flash Sale <br> Sastra</h3>
                    <p class="text-indigo-100 text-sm mt-2 font-medium">Berakhir dalam 02:45:12</p>
                </div>
                <div class="flex items-center gap-2 text-white font-bold group-hover:gap-4 transition-all cursor-pointer">
                    Cek Produk <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:rotate-12 transition-transform">⚡</div>
        </div>

        {{-- Member Eksklusif --}}
        <div class="relative rounded-[2.5rem] overflow-hidden bg-slate-900 p-8 group border border-white/5">
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-black text-white leading-tight">Member <br> Eksklusif</h3>
                    <p class="text-slate-500 text-sm mt-2">Poin 2x lipat setiap beli buku Kedokteran.</p>
                </div>
                <div class="w-fit px-4 py-2 bg-slate-800 text-blue-400 text-xs font-black rounded-lg border border-blue-500/20">
                    DAFTAR GRATIS
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:-rotate-12 transition-transform">💎</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi Swiper
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "slide",
        });

        // GSAP Animations
        const tlHero = gsap.timeline();
        
        tlHero.from(".lg:col-span-8", {
            x: -50,
            opacity: 0,
            duration: 1,
            ease: "power4.out"
        })
        .from(".lg:col-span-4 > div", {
            x: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power4.out"
        }, "-=0.8");

        gsap.from(".swiper", {
            scale: 0.95,
            opacity: 0,
            duration: 1.2,
            ease: "expo.out",
            delay: 0.2
        });
    });
</script>

<style>
    .swiper-pagination-bullet {
        background: #ffffff !important;
        opacity: 0.3;
    }
    .swiper-pagination-bullet-active {
        background: #3b82f6 !important;
        width: 24px !important;
        border-radius: 10px !important;
        opacity: 1;
    }
</style>
@endpush