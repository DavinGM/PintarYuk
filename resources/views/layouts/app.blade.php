<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <script>
        // Smooth Scroll Initialization (Lenis)
        const lenis = new Lenis({
            duration: 2.2, 
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), 
            wheelMultiplier: 0.8, 
            touchMultiplier: 1.5,
            infinite: false,
            smoothWheel: true,
            smoothTouch: true,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #020617; color: white; font-family: 'Figtree', sans-serif; }
        body.loading { overflow: hidden; }
        
        /* Custom Scrollbar for Results */
        #results-container::-webkit-scrollbar { width: 4px; }
        #results-container::-webkit-scrollbar-track { background: transparent; }
        #results-container::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        
        /* Search Overlay Transition */
        #search-overlay.hidden { display: none; }
    </style>
</head>

<body class="antialiased selection:bg-blue-500/30">

    <div id="preloader" class="fixed inset-0 z-[9999] bg-slate-950 flex flex-col items-center justify-center overflow-hidden">
        <div id="loader-logo" class="relative">
            <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center shadow-[0_0_50px_rgba(37,99,235,0.3)]">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div class="absolute inset-0 w-20 h-20 border-2 border-blue-500 rounded-2xl animate-ping opacity-20"></div>
        </div>
        <div class="mt-10 w-48 h-[2px] bg-white/10 rounded-full overflow-hidden relative">
            <div id="loader-progress" class="absolute top-0 left-0 h-full w-0 bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.8)]"></div>
        </div>
        <div id="loader-text" class="mt-4 text-slate-500 font-black text-[10px] uppercase tracking-[0.5em] animate-pulse">Initializing Experience</div>
    </div>

    <div id="search-overlay" class="fixed inset-0 z-[100] hidden bg-[#020617]/95 backdrop-blur-md">
        <div class="max-w-2xl mx-auto mt-24 px-4">
            <div class="bg-slate-900 border border-white/10 rounded-[2.5rem] shadow-2xl overflow-hidden shadow-blue-500/10">
                <div class="p-6 border-b border-white/5 flex items-center gap-4">
                    <span class="text-blue-500 font-black text-xl italic">/</span>
                    <input type="text" id="input-search" 
                        class="w-full bg-transparent border-none text-white text-lg focus:ring-0 placeholder:text-slate-600 font-bold"
                        placeholder="Type to search books, authors, or genres..." autocomplete="off">
                </div>
                <div id="results-container" class="p-4 max-h-[450px] overflow-y-auto">
                    </div>
                <div class="p-4 bg-white/5 border-t border-white/5 flex justify-between text-[9px] font-black text-slate-500 uppercase tracking-widest">
                    <div class="flex gap-4">
                        <span>↑↓ Navigate</span>
                        <span>↵ Select</span>
                    </div>
                    <span>ESC to close</span>
                </div>
            </div>
        </div>
    </div>

    <div class="min-h-screen relative">
        @include('layouts.navigation')

        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <script>
        // 1. PRELOADER LOGIC
        document.body.classList.add('loading');
        window.addEventListener('load', () => {
            const tl = gsap.timeline({
                onComplete: () => {
                    document.getElementById('preloader').remove();
                    document.body.classList.remove('loading');
                }
            });
            tl.to("#loader-progress", { width: "100%", duration: 0.8, ease: "power2.inOut" })
              .to("#loader-logo", { scale: 1.5, opacity: 0, duration: 0.5, ease: "power4.in" }, "+=0.2")
              .to("#loader-text", { y: 20, opacity: 0, duration: 0.3 }, "-=0.3")
              .to("#preloader", { yPercent: -100, duration: 1, ease: "expo.inOut" });
        });

        // 2. SEARCH COMMAND PALETTE LOGIC
        const searchOverlay = document.getElementById('search-overlay');
        const searchInput = document.getElementById('input-search');
        const resultsContainer = document.getElementById('results-container');
        let selectedIndex = -1;

        // Open/Close Shortcut
        document.addEventListener('keydown', e => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchOverlay.classList.toggle('hidden');
                if(!searchOverlay.classList.contains('hidden')) {
                    searchInput.focus();
                    lenis.stop(); // Berhentikan scroll utama saat search buka
                } else {
                    lenis.start();
                }
            }
            if (e.key === 'Escape') {
                searchOverlay.classList.add('hidden');
                lenis.start();
            }
        });

        // Live Search AJAX
        searchInput.addEventListener('input', async () => {
            const q = searchInput.value;
            if(q.length < 2) { resultsContainer.innerHTML = ''; return; }

            try {
                const res = await fetch(`/api/search?q=${q}`);
                const data = await res.json();
                
                if(data.length === 0) {
                    resultsContainer.innerHTML = '<p class="text-slate-600 text-center p-8 italic text-sm">No matches found.</p>';
                    return;
                }

                resultsContainer.innerHTML = data.map((item, i) => `
                    <a href="${item.url}" class="result-item flex items-center justify-between p-4 rounded-2xl transition-all group hover:bg-blue-600 active:scale-[0.98]">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-14 bg-slate-800 rounded-lg overflow-hidden flex-shrink-0 border border-white/5">
                                <img src="${item.cover}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-blue-500 group-hover:text-blue-100 uppercase tracking-tighter mb-1">
                                    ${item.label} : <span class="text-white">${q}</span>
                                </p>
                                <h4 class="text-white font-bold text-sm leading-tight">${item.title}</h4>
                                <p class="text-slate-500 group-hover:text-blue-200 text-[10px] mt-1 italic">${item.author}</p>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-700 group-hover:text-white group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </a>
                `).join('');
            } catch (err) {
                console.error('Search error:', err);
            }
        });

        // Keyboard Navigation & Enter Selection
        searchInput.addEventListener('keydown', e => {
            const items = document.querySelectorAll('.result-item');
            
            if (e.key === 'Enter') {
                if (items.length > 0) {
                    const target = selectedIndex === -1 ? items[0] : items[selectedIndex];
                    window.location.href = target.href;
                } else if(searchInput.value.trim() !== '') {
                    window.location.href = `/search/results?q=${searchInput.value}`;
                }
            }
        });
    </script>

</body>
</html>