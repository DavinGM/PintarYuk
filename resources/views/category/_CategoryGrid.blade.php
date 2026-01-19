<section class="relative mb-24">
    <div class="reveal-up flex items-center gap-3 mb-8">
        <span class="text-blue-500 font-black text-[10px] tracking-[0.3em] uppercase">Pilih Genre Utama</span>
        <div class="h-[1px] flex-grow bg-white/5"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
        {{-- SAINS --}}
        <div class="category-card md:col-span-2 md:row-span-2 group relative overflow-hidden rounded-[2.5rem] bg-slate-900/40 border border-white/5 p-8 flex flex-col justify-end min-h-[450px] cursor-pointer">
            <img src="https://images.unsplash.com/photo-1507413245164-6160d8298b31?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:scale-110 transition-transform duration-1000">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-white mb-2">Sains</h3>
                <p class="text-slate-400 text-xs font-medium">Masa depan & Inovasi</p>
            </div>
        </div>

        {{-- FILOSOFI --}}
        <div class="category-card md:col-span-5 group relative overflow-hidden rounded-[2.5rem] bg-slate-900/40 border border-white/5 p-8 flex items-center justify-between min-h-[210px] cursor-pointer">
            <div class="relative z-10">
                <h3 class="text-3xl font-black text-white mb-2 tracking-tight uppercase">Filosofi Dunia</h3>
                <p class="text-slate-400 text-sm max-w-xs font-medium">Memahami akar pemikiran manusia melalui sejarah.</p>
            </div>
            <div class="w-24 h-24 bg-blue-500/10 rounded-3xl flex items-center justify-center rotate-12 group-hover:rotate-0 transition-all duration-500 border border-blue-500/20 hidden md:flex">
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
            </div>
        </div>

        {{-- SELF DEV --}}
        <div class="category-card md:col-span-3 group relative overflow-hidden rounded-[2.5rem] bg-emerald-500/5 border border-white/5 p-8 hover:bg-emerald-500/10 transition-all duration-500 min-h-[220px] cursor-pointer">
            <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-500 mb-12">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3 class="text-xl font-bold text-white">Pengembangan Diri</h3>
        </div>

        {{-- ROMANSA --}}
        <div class="category-card md:col-span-2 group relative overflow-hidden rounded-[2.5rem] bg-rose-500/5 border border-white/5 p-8 hover:bg-rose-500/10 transition-all duration-500 min-h-[220px] cursor-pointer">
            <div class="w-10 h-10 bg-rose-500/20 rounded-xl flex items-center justify-center text-rose-500 mb-12">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-white tracking-tight">Romansa</h3>
        </div>

        {{-- OTHERS --}}
        <div class="md:col-span-7 mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach($categories as $category)
                <a href="{{ route('category.show', $category['slug']) }}">
                    <div class="category-card p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-white/20 transition-all flex items-center justify-between group cursor-pointer">
                        <span class="text-xs font-bold text-slate-300 group-hover:text-white">
                            {{ $category['name'] }}
                        </span>

                        <svg
                            class="w-3 h-3 text-slate-600 group-hover:translate-x-1 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>