<nav id="main-nav" x-data="{ open: false }" class="fixed top-0 w-full z-50 py-4 bg-transparent border-b border-transparent">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-2 group cursor-pointer" id="nav-logo">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">
                    {{ config('web.name') }}
                </span>
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-10 text-sm font-medium text-slate-300" id="nav-links">
            <a href="#" class="hover:text-blue-400 transition-colors">Jelajahi</a>
            <a href="#" class="hover:text-blue-400 transition-colors">Kategori</a>
            <a href="#" class="hover:text-blue-400 transition-colors">Promo</a>
            <a href="#" class="hover:text-blue-400 transition-colors">Testimoni</a>
        </div>

        <div class="flex items-center gap-4" id="nav-auth">
            @auth
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                                <span class="font-medium text-sm">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="text-red-500">Keluar</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-slate-300 font-medium text-sm hidden sm:block hover:text-white transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                    Mulai Belajar
                </a>
            @endauth

            <button @click="open = ! open" class="md:hidden text-slate-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="md:hidden bg-slate-900 border-b border-white/10 px-6 py-4 space-y-4">
        <a href="#" class="block text-slate-300">Koleksi</a>
        <a href="#" class="block text-slate-300">Kategori</a>
        @auth
            <a href="{{ route('profile.edit') }}" class="block text-slate-300">Profile</a>
        @endauth
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('main-nav');
    let lastScrollY = window.scrollY;

    // 1. SET INITIAL STATE (Pastikan transparan di awal)
    gsap.set(nav, { 
        backgroundColor: "rgba(15, 23, 42, 0)", 
        borderBottomColor: "rgba(255, 255, 255, 0)",
        backdropFilter: "blur(0px)" 
    });

    // 2. ANIMASI INTRO (Hanya dijalankan SEKALI saat page load)
    const tl = gsap.timeline({ defaults: { ease: "power4.out" } });
    
    tl.from(nav, { y: -100, duration: 1.2 })
      .from("#nav-logo", { x: -50, opacity: 0, duration: 0.8 }, "-=0.6")
      .from("#nav-links a", { y: -20, opacity: 0, duration: 0.5, stagger: 0.1 }, "-=0.4")
      .from("#nav-auth", { x: 50, opacity: 0, duration: 0.8 }, "-=0.6");

    // 3. LOGIKA SCROLL (Background & Auto-Hide)
    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        // A. Kontrol Warna Background & Blur
        if (currentScrollY > 50) {
            gsap.to(nav, {
                backgroundColor: "rgba(15, 23, 42, 0.8)", // Slate-900 dengan transparansi
                backdropFilter: "blur(12px)",
                borderBottomColor: "rgba(255, 255, 255, 0.1)",
                paddingTop: "0.5rem",
                paddingBottom: "0.5rem",
                duration: 0.4
            });
        } else {
            gsap.to(nav, {
                backgroundColor: "rgba(15, 23, 42, 0)",
                backdropFilter: "blur(0px)",
                borderBottomColor: "rgba(255, 255, 255, 0)",
                paddingTop: "1rem", 
                paddingBottom: "1rem",
                duration: 0.4
            });
        }

        // B. Kontrol Auto-Hide (Sembunyi saat scroll bawah, muncul saat scroll atas)
        if (currentScrollY > 500) { // Hanya aktif setelah scroll agak jauh
            if (currentScrollY > lastScrollY) {
                // Scroll Ke Bawah - Sembunyikan Nav
                gsap.to(nav, { y: -120, duration: 0.5, ease: "power2.inOut" });
            } else {
                // Scroll Ke Atas - Tampilkan Nav
                gsap.to(nav, { y: 0, duration: 0.5, ease: "power2.out" });
            }
        } else {
            // Pastikan nav tetap muncul jika masih di area atas
            gsap.to(nav, { y: 0, duration: 0.5 });
        }

        lastScrollY = currentScrollY;
    });
});





// A
    document.addEventListener('DOMContentLoaded', () => {
        const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

        // Animasi Navbar muncul dari atas
        tl.from("#main-nav", {
            y: -100,
            duration: 1.2
        })
        // Animasi Logo masuk (slide ke kanan)
        .from("#nav-logo", {
            x: -50,
            opacity: 0,
            duration: 0.8
        }, "-=0.6")
        // Animasi link menu satu per satu (Stagger)
        .from("#nav-links a", {
            y: -20,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1
        }, "-=0.4")
        // Animasi Auth button
        .from("#nav-auth", {
            x: 50,
            opacity: 0,
            duration: 0.8
        }, "-=0.6");
    });
</script>