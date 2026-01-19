<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Dilarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white antialiased overflow-hidden">
    <div class="relative min-h-screen flex items-center justify-center px-6">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-rose-600/20 blur-[120px] rounded-full"></div>

        <div class="relative z-10 text-center">
            <h1 class="text-[12rem] md:text-[18rem] font-black leading-none tracking-tighter text-rose-500/10 select-none">403</h1>
            <div class="-mt-20 md:-mt-32">
                <div class="inline-block px-4 py-1 border border-rose-500/30 bg-rose-500/10 rounded-full mb-6">
                    <span class="text-rose-500 text-xs font-black uppercase tracking-[0.2em]">Akses Ditolak</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-bold mb-4 uppercase tracking-tight">Area <span class="text-rose-600 italic font-light">Terlarang</span></h2>
                <p class="text-slate-400 text-lg max-w-md mx-auto mb-10 leading-relaxed">
                    Maaf, kamu tidak memiliki izin untuk mengakses area ini. Silahkan kembali ke jalan yang benar.
                </p>
                <a href="{{ url('/') }}" class="px-8 py-4 bg-rose-600 text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-rose-700 transition-all shadow-xl shadow-rose-600/20 active:scale-95">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>