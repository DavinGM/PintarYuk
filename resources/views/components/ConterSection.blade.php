<section id="limit-section" class="py-24 bg-slate-950 border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16">
            <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">Live Statistics</span>
            <h2 class="text-white text-3xl font-bold mt-2">Transparansi Data Kami.</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 md:gap-8">
            
            <div class="stat-item">
                <div class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-2">Buku Terjual</div>
                <div class="flex items-baseline gap-1">
                    <span class="counter-value text-5xl md:text-7xl font-black text-white tabular-nums tracking-tighter" data-target="15400">0</span>
                    <span class="text-blue-500 font-bold">+</span>
                </div>
                <div class="h-1 w-12 bg-blue-600 mt-4 rounded-full shadow-[0_0_15px_rgba(37,99,235,0.6)]"></div>
            </div>

            <div class="stat-item">
                <div class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-2">Stok Tersedia</div>
                <div class="flex items-baseline gap-1">
                    <span class="counter-value text-5xl md:text-7xl font-black text-white tabular-nums tracking-tighter" data-target="8200">0</span>
                </div>
                <div class="h-1 w-12 bg-emerald-500 mt-4 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.6)]"></div>
            </div>

            <div class="stat-item">
                <div class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-2">Pembeli Aktif</div>
                <div class="flex items-baseline gap-1">
                    <span class="counter-value text-5xl md:text-7xl font-black text-white tabular-nums tracking-tighter" data-target="1250">0</span>
                    <span class="text-indigo-500 font-bold">K</span>
                </div>
                <div class="h-1 w-12 bg-indigo-500 mt-4 rounded-full shadow-[0_0_15px_rgba(99,102,241,0.6)]"></div>
            </div>

            <div class="stat-item">
                <div class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-2">Daily Visitors</div>
                <div class="flex items-baseline gap-1">
                    <span class="counter-value text-5xl md:text-7xl font-black text-white tabular-nums tracking-tighter" data-target="4500">0</span>
                </div>
                <div class="h-1 w-12 bg-rose-500 mt-4 rounded-full shadow-[0_0_15px_rgba(244,63,94,0.6)]"></div>
            </div>

        </div>
    </div>
</section>
@push('scripts')
<script>
    (function() {
        const initCounter = () => {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                const counters = document.querySelectorAll('.counter-value');
                
                counters.forEach(counter => {
                    const targetValue = parseInt(counter.getAttribute('data-target'));
                    
                    // Membuat objek dummy untuk di-animasikan propertinya
                    const obj = { value: 0 };

                    gsap.to(obj, {
                        value: targetValue,
                        duration: 3, // Durasi angka merayap naik
                        ease: "power3.out", // Melambat di akhir agar dramatis
                        scrollTrigger: {
                            trigger: counter,
                            start: "top 90%", // Mulai saat elemen terlihat di bawah
                            toggleActions: "play none none reverse",
                        },
                        onUpdate: () => {
                            // Format angka dengan ribuan (contoh: 15.400)
                            counter.innerText = Math.floor(obj.value).toLocaleString('id-ID');
                        }
                    });
                });

                // Animasi Reveal untuk kontainer statistik
                gsap.from(".stat-item", {
                    scrollTrigger: {
                        trigger: "#limit-section",
                        start: "top 80%",
                    },
                    y: 30,
                    opacity: 0,
                    stagger: 0.2,
                    duration: 1,
                    ease: "expo.out"
                });
            }
        };

        window.addEventListener('load', initCounter);
    })();
</script>
@endpush