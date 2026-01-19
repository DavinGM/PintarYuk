{{-- Hero Section as a Seamless Component --}}
<header class="relative pt-12 pb-20">
    {{-- Glow Ambient: Dibuat lebih lebar agar menyatu dengan background body --}}
    <div class="absolute top-[-100px] left-1/2 -translate-x-1/2 w-full h-[500px] pointer-events-none">
        <div class="absolute top-0 left-[10%] w-[400px] h-[400px] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-[10%] w-[300px] h-[300px] bg-indigo-600/5 blur-[100px] rounded-full"></div>
    </div>

    <div class="relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-12">
            
            {{-- Text Content --}}
            <div class="flex-1">
                <div class="reveal-up inline-flex items-center gap-3 mb-6">
                    <div class="h-[1px] w-10 bg-gradient-to-r from-blue-500 to-transparent"></div>
                    <span class="text-blue-500 font-bold tracking-[0.4em] uppercase text-[10px]">Eksplorasi Katalog</span>
                </div>
                
                <h1 class="reveal-up text-5xl md:text-7xl font-black text-white leading-[0.9] tracking-tighter mb-8 uppercase">
                    Pilih <span class="text-slate-500 italic font-light lowercase">dan</span> <br>
                    Temukan <span class="relative">
                        Minatmu
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-blue-600/40" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 25 0, 50 5 T 100 5" fill="none" stroke="currentColor" stroke-width="4"/></svg>
                    </span>
                </h1>
                
                <p class="reveal-up text-slate-400 text-lg font-medium max-w-xl leading-relaxed">
                    Navigasi melalui ribuan koleksi literatur yang dikelompokkan secara cerdas untuk mempermudah pencarian wawasan baru Anda.
                </p>
            </div>

            {{-- Search Bar: Dibuat lebih menyatu (Minimalist) --}}
            <div class="reveal-up w-full lg:w-[400px] mb-2">
                <div class="relative group">
                    {{-- Aura di sekitar search bar saat hover --}}
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-700"></div>
                    
                    <div class="relative flex items-center bg-slate-900/40 backdrop-blur-xl border border-white/5 rounded-2xl p-2 group-focus-within:border-blue-500/50 transition-all">
                        <div class="flex-grow flex items-center px-4 gap-3">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" placeholder="Cari genre spesifik..." 
                                class="bg-transparent border-none outline-none w-full text-white placeholder:text-slate-600 text-sm focus:ring-0">
                        </div>
                        <button class="bg-blue-600 text-white px-5 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-blue-500 transition-all shadow-lg shadow-blue-600/20">
                            Cari
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>