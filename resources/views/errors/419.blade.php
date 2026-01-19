<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Sesi Berakhir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white antialiased overflow-hidden">
    <div class="relative min-h-screen flex items-center justify-center px-6">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 blur-[120px] rounded-full"></div>

        <div class="relative z-10 text-center">
            {{-- Icon Animasi Refresh --}}
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 bg-emerald-500/10 border border-emerald-500/20 rounded-3xl flex items-center justify-center animate-spin [animation-duration:10s]">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>

            <div class="relative">
                <h1 class="text-[8rem] md:text-[12rem] font-black leading-none tracking-tighter text-emerald-500/10 select-none uppercase">Expired</h1>
                <div class="-mt-16 md:-mt-20">
                    <h2 class="text-3xl md:text-5xl font-bold mb-4 uppercase tracking-tight">Sesi <span class="text-emerald-500 italic font-light">Habis</span></h2>
                    <p class="text-slate-400 text-lg max-w-md mx-auto mb-10 leading-relaxed">
                        Halaman ini sudah terlalu lama terbuka. Demi keamanan, silakan refresh halaman untuk melanjutkan.
                    </p>
                    
                    {{-- Tombol Refresh --}}
                    <button onclick="window.location.reload()" class="group relative px-8 py-4 bg-emerald-600 text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-emerald-500 transition-all shadow-xl shadow-emerald-600/20 active:scale-95">
                        <div class="flex items-center gap-3">
                            <span>Muat Ulang Halaman</span>
                            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>