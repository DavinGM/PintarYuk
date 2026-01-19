<section id="reason-section" class="relative py-32 bg-slate-950 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-indigo-500/10 via-transparent to-transparent opacity-50"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20">
            <h2 id="reason-title" class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter">
                Kenapa Harus <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-emerald-400"><u>PintarYuk?</u></span>
            </h2>
            <p id="reason-subtitle" class="text-slate-400 text-lg max-w-2xl mx-auto font-medium">
                Kami Memiliki Koleksi Buku Pelajar yang luas dan Terjamin Kualitasnya. Semua detail buku dan konten di dalamnya sudah kami sesuai dengan regulasi yang berlaku, sehingga cocok untuk kamu sebagai Pelajar mencari buku dengan harga terjangkau murah aman dan pastinya legal Se-Indonesia.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="reason-card group relative p-8 rounded-3xl bg-slate-900/50 border border-white/10 backdrop-blur-sm hover:border-indigo-500/50 transition-colors duration-500">
                <div class="w-16 h-16 bg-indigo-500/20 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🚚</div>
                <h3 class="text-xl font-bold text-white mb-4">Pengiriman Terjamin</h3>
                <p class="text-slate-400 leading-relaxed">Ujian sudah dekat? Jangan khawatir. Kami menjamin buku sampai ke tujuan dari jarak berapapun.</p>
                <div class="absolute -bottom-2 -right-2 text-6xl opacity-5 grayscale group-hover:grayscale-0 group-hover:opacity-10 transition-all">🚀</div>
            </div>

            <div class="reason-card group relative p-8 rounded-3xl bg-slate-900/50 border border-white/10 backdrop-blur-sm hover:border-emerald-500/50 transition-colors duration-500">
                <div class="w-16 h-16 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🏷️</div>
                <h3 class="text-xl font-bold text-white mb-4">Harga Kantong Pelajar</h3>
                <p class="text-slate-400 leading-relaxed">Diskon khusus pemegang kartu pelajar hingga 40%. Karena ilmu tidak harus mahal.</p>
                <div class="absolute -bottom-2 -right-2 text-6xl opacity-5 grayscale group-hover:grayscale-0 group-hover:opacity-10 transition-all">💸</div>
            </div>

            <div class="reason-card group relative p-8 rounded-3xl bg-slate-900/50 border border-white/10 backdrop-blur-sm hover:border-purple-500/50 transition-colors duration-500">
                <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">💎</div>
                <h3 class="text-xl font-bold text-white mb-4">Kualitas Terbaik</h3>
                <p class="text-slate-400 leading-relaxed">Hanya menjual buku original 100%. Tidak ada cetakan bajakan yang merusak mata dan semangat belajar.</p>
                <div class="absolute -bottom-2 -right-2 text-6xl opacity-5 grayscale group-hover:grayscale-0 group-hover:opacity-10 transition-all">✨</div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        const initReasons = () => {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // 1. Animasi Title & Subtitle (Split Text Manual)
                const title = document.getElementById('reason-title');
                const words = title.innerText.split(" ");
                title.innerHTML = words.map(word => `<span class="inline-block">${word}</span>`).join(" ");

                gsap.from("#reason-title span", {
                    scrollTrigger: {
                        trigger: "#reason-title",
                        start: "top 80%",
                    },
                    y: 50,
                    opacity: 0,
                    stagger: 0.1,
                    duration: 1,
                    ease: "back.out(1.7)"
                });

                gsap.from("#reason-subtitle", {
                    scrollTrigger: {
                        trigger: "#reason-subtitle",
                        start: "top 85%",
                    },
                    y: 30,
                    opacity: 0,
                    duration: 1,
                    delay: 0.3
                });

                // 2. Animasi Cards (Stagger Rise)
                gsap.from(".reason-card", {
                    scrollTrigger: {
                        trigger: ".reason-card",
                        start: "top 80%",
                    },
                    y: 100,
                    opacity: 0,
                    stagger: 0.2,
                    duration: 1.2,
                    ease: "power4.out"
                });

                // 3. Efek Floating halus untuk kartu (Continuous)
                gsap.to(".reason-card", {
                    y: "-=10",
                    duration: 2,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    stagger: 0.3
                });
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initReasons);
        } else {
            initReasons();
        }
    })();
</script>
@endpush