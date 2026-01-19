@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="stat-card bg-slate-900/40 border border-white/5 p-6 rounded-[2rem] relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Buku</p>
            <h4 class="text-3xl font-black text-white">1,284</h4>
            <p class="text-[10px] text-green-500 mt-2 font-bold">+12% dari bulan lalu</p>
        </div>

        <div class="stat-card bg-slate-900/40 border border-white/5 p-6 rounded-[2rem] relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Member Aktif</p>
            <h4 class="text-3xl font-black text-white">852</h4>
            <p class="text-[10px] text-blue-500 mt-2 font-bold">42 Member baru hari ini</p>
        </div>

        <div class="stat-card bg-slate-900/40 border border-white/5 p-6 rounded-[2rem] relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity text-red-500">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
            </div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Peminjaman</p>
            <h4 class="text-3xl font-black text-white">124</h4>
            <p class="text-[10px] text-red-400 mt-2 font-bold">5 Buku terlambat kembali</p>
        </div>
    </div>

    <div class="bg-slate-900/40 border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-sm font-black uppercase tracking-widest text-white">Log Aktivitas Terbaru</h5>
            <button class="text-[10px] font-black text-blue-500 border border-blue-500/20 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white transition-all">LIHAT SEMUA</button>
        </div>
        
        <div class="space-y-4">
            @for ($i = 1; $i <= 3; $i++)
            <div class="activity-item flex items-center justify-between p-4 rounded-2xl hover:bg-white/5 transition-all border border-transparent hover:border-white/5">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-lg">📖</div>
                    <div>
                        <p class="text-xs font-bold text-white">Buku "The Art of War" dipinjam</p>
                        <p class="text-[10px] text-slate-500">Oleh Member #0293 • 2 Jam yang lalu</p>
                    </div>
                </div>
                <span class="text-[9px] font-black text-blue-500 bg-blue-500/10 px-3 py-1 rounded-full uppercase">Selesai</span>
            </div>
            @endfor
        </div>
    </div>

    <script>
        gsap.from(".stat-card", {
            y: 30,
            opacity: 0,
            stagger: 0.15,
            duration: 1.2,
            ease: "expo.out",
            delay: 0.5
        });
        
        gsap.from(".activity-item", {
            x: -20,
            opacity: 0,
            stagger: 0.1,
            duration: 1,
            ease: "power2.out",
            delay: 1
        });
    </script>
@endsection