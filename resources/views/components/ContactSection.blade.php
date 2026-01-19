<section id="contact-section" class="py-32 bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            
            <div class="contact-info">
                <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">Get In Touch</span>
                <h2 class="text-6xl md:text-8xl font-black text-white tracking-tighter leading-[0.85] mt-6">
                    MARI <br> <span class="text-slate-700">BICARA.</span>
                </h2>
                <p class="text-slate-400 text-xl mt-8 max-w-md leading-relaxed">
                    Punya pertanyaan tentang buku tertentu atau butuh rekomendasi bacaan? Tim kurator kami siap membantu Anda 24/7.
                </p>

                <div class="mt-12 space-y-8">
                    <div class="flex items-center gap-6 group">
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-blue-600 transition-all duration-500">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs font-black uppercase tracking-widest">Email Resmi</p>
                            <p class="text-white text-lg font-bold">{{ env('EMAIL') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 group">
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-emerald-500 transition-all duration-500">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs font-black uppercase tracking-widest">Lokasi Fisik</p>
                            <p class="text-white text-lg font-bold">{{ env('LOKASI') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-blue-600/20 to-purple-600/20 blur-2xl rounded-[3rem]"></div>
                
                <form class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-10 md:p-14 rounded-[3rem] space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Nama</label>
                            <input type="text" placeholder="Nama Kamu" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Subjek</label>
                            <input type="text" placeholder="Tanya..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Email</label>
                        <input type="email" placeholder="your@example.com" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Pesan Anda</label>
                        <textarea rows="4" placeholder="Halo. saya ingin mencari buku..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"></textarea>
                    </div>

                    <button type="button" class="group w-full relative overflow-hidden bg-white py-5 rounded-2xl transition-all active:scale-95">
                        <div class="absolute inset-0 bg-blue-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        <span class="relative z-10 text-slate-950 group-hover:text-white font-black uppercase tracking-widest transition-colors">Kirim Pesan</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
@push('scripts')
<script>
    (function() {
        const initContact = () => {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: "#contact-section",
                        start: "top 70%",
                    }
                });

                // Animasi Info (Kiri)
                tl.from(".contact-info h2", { y: 100, opacity: 0, duration: 1, ease: "power4.out" })
                  .from(".contact-info p", { y: 20, opacity: 0, duration: 0.8 }, "-=0.6")
                  .from(".contact-info .group", { x: -30, opacity: 0, stagger: 0.2, duration: 0.8 }, "-=0.4")
                  
                // Animasi Form (Kanan) - Muncul dengan gaya Pop-up halus
                tl.from(".contact-form-wrapper", { 
                    scale: 0.9, 
                    opacity: 0, 
                    duration: 1.2, 
                    ease: "back.out(1.7)" 
                }, "-=1.2");
            }
        };

        window.addEventListener('load', initContact);
    })();
</script>
@endpush