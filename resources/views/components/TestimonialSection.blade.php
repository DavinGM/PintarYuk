<section id="testimonials" class="py-32 bg-slate-950 overflow-hidden relative">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 mb-20 relative z-10 text-center">
        <h2 class="text-5xl md:text-7xl font-black text-white tracking-tighter mb-6">
            KATA <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">MEREKA.</span>
        </h2>
        <p class="text-slate-400 text-lg max-w-xl mx-auto italic">
            "Bukan sekadar transaksi, tapi tentang perjalanan intelektual yang kami bangun bersama Anda."
        </p>
    </div>

    <div class="marquee-wrapper flex gap-6 mb-6">
        <div class="marquee-content flex gap-6 py-4">
            @php
                $testimonials = [
                    ['name' => 'Budi Santoso', 'role' => 'Mahasiswa ITB', 'text' => 'Buku original dan sampai dalam 1 hari. Sangat membantu saat deadline skripsi!', 'img' => 'https://i.pravatar.cc/150?u=1'],
                    ['name' => 'Siti Aminah', 'role' => 'Dosen UNPAD', 'text' => 'Koleksi jurnal internasionalnya lengkap. Tidak perlu lagi impor manual dari luar negeri.', 'img' => 'https://i.pravatar.cc/150?u=2'],
                    ['name' => 'Rizky Fauzi', 'role' => 'Pelajar SMA', 'text' => 'Diskon kartu pelajarnya asli kerasa banget. Akhirnya bisa beli buku olimpiade.', 'img' => 'https://i.pravatar.cc/150?u=3'],
                    ['name' => 'Dewi Lestari', 'role' => 'Penulis', 'text' => 'Sangat menghargai hak cipta. Tidak ada buku bajakan di sini. Salut!', 'img' => 'https://i.pravatar.cc/150?u=4'],
                ];
            @endphp

            @foreach(array_merge($testimonials, $testimonials) as $testi) {{-- Duplicate for infinite loop --}}
            <div class="testi-card w-[350px] md:w-[450px] flex-shrink-0 p-8 rounded-[2.5rem] bg-white/[0.03] border border-white/10 backdrop-blur-md hover:bg-white/[0.07] hover:border-blue-500/30 transition-all duration-500">
                <div class="flex gap-4 items-center mb-6">
                    <img src="{{ $testi['img'] }}" class="w-14 h-14 rounded-full grayscale hover:grayscale-0 transition-all">
                    <div>
                        <h4 class="text-white font-bold">{{ $testi['name'] }}</h4>
                        <p class="text-blue-500 text-xs font-black uppercase tracking-widest">{{ $testi['role'] }}</p>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed italic text-lg">"{{ $testi['text'] }}"</p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="marquee-wrapper-reverse flex gap-6">
        <div class="marquee-content-reverse flex gap-6 py-4">
            @foreach(array_merge($testimonials, $testimonials) as $testi)
            <div class="testi-card w-[350px] md:w-[450px] flex-shrink-0 p-8 rounded-[2.5rem] bg-white/[0.03] border border-white/10 backdrop-blur-md hover:bg-white/[0.07] hover:border-emerald-500/30 transition-all duration-500">
                <div class="flex gap-4 items-center mb-6">
                    <img src="{{ $testi['img'] }}" class="w-14 h-14 rounded-full grayscale hover:grayscale-0 transition-all">
                    <div>
                        <h4 class="text-white font-bold">{{ $testi['name'] }}</h4>
                        <p class="text-emerald-500 text-xs font-black uppercase tracking-widest">{{ $testi['role'] }}</p>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed italic text-lg">"{{ $testi['text'] }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        const initTestimonials = () => {
            if (typeof gsap !== 'undefined') {
                // Baris Pertama ke Kiri
                const marquee1 = gsap.to(".marquee-content", {
                    xPercent: -50,
                    ease: "none",
                    duration: 30, // Kecepatan pergerakan
                    repeat: -1
                });

                // Baris Kedua ke Kanan
                const marquee2 = gsap.to(".marquee-content-reverse", {
                    xPercent: 0,
                    ease: "none",
                    duration: 30,
                    repeat: -1,
                    startAt: { xPercent: -50 }
                });

                // Interaktivitas: Pause saat Hover
                document.querySelectorAll('.marquee-wrapper, .marquee-wrapper-reverse').forEach(wrapper => {
                    wrapper.addEventListener('mouseenter', () => {
                        marquee1.pause();
                        marquee2.pause();
                    });
                    wrapper.addEventListener('mouseleave', () => {
                        marquee1.play();
                        marquee2.play();
                    });
                });

                // Reveal Animation saat Scroll ke Section ini
                gsap.from("#testimonials h2, #testimonials p", {
                    scrollTrigger: {
                        trigger: "#testimonials",
                        start: "top 80%",
                    },
                    y: 50,
                    opacity: 0,
                    stagger: 0.2,
                    duration: 1.5,
                    ease: "expo.out"
                });
            }
        };

        window.addEventListener('load', initTestimonials);
    })();
</script>
@endpush