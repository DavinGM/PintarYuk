<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>
<body class="bg-slate-950 text-white antialiased overflow-hidden">

    <div class="relative min-h-screen flex items-center justify-center px-6">
        {{-- Aesthetic Background Glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600/20 blur-[120px] rounded-full"></div>

        <div class="relative z-10 text-center">
            {{-- Animasi Angka 404 --}}
            <h1 id="error-code" class="text-[12rem] md:text-[18rem] font-black leading-none tracking-tighter text-white/5 select-none">
                404
            </h1>

            <div id="error-content" class="-mt-20 md:-mt-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-4 uppercase tracking-tight">
                    Ups! Tersesat <span class="text-slate-500 italic font-light">Jauh?</span>
                </h2>
                <p class="text-slate-400 text-lg max-w-md mx-auto mb-10 leading-relaxed">
                    Halaman yang kamu cari tidak ada atau mungkin sudah pindah ke dimensi lain.
                </p>

                {{-- Action Buttons --}}
                <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                    <a href="{{ url('/') }}" class="px-8 py-4 bg-white text-slate-950 font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-xl shadow-white/5 active:scale-95">
                        Kembali Beranda
                    </a>
                    <button onclick="history.back()" class="px-8 py-4 bg-white/5 border border-white/10 text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-white/10 transition-all duration-300 active:scale-95">
                        Halaman Sebelumnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animasi Masuk
        document.addEventListener('DOMContentLoaded', () => {
            gsap.from("#error-code", {
                opacity: 0,
                scale: 0.8,
                duration: 1.5,
                ease: "expo.out"
            });
            gsap.from("#error-content", {
                opacity: 0,
                y: 50,
                duration: 1,
                delay: 0.5,
                ease: "power4.out"
            });
        });
    </script>
</body>
</html>