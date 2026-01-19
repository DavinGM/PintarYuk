<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | PintarBuku</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Figtree', sans-serif; }
        .sidebar-link.active { background: rgba(37, 99, 235, 0.1); border-right: 3px solid #2563eb; color: white; }
    </style>
</head>
<body class="bg-[#020617] text-slate-100 overflow-x-hidden">

<div class="flex min-h-screen relative">
    
    <aside id="sidebar" class="w-64 bg-slate-900/50 backdrop-blur-xl border-r border-white/5 p-6 fixed h-full z-50">
        <div class="flex items-center gap-3 mb-10 pl-2" id="side-logo">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h1 class="text-sm font-black tracking-[0.3em] text-white">CORE ADMIN</h1>
        </div>

        <nav class="space-y-2 text-[11px] font-black uppercase tracking-widest">
            <p class="text-slate-600 mb-4 pl-3 tracking-[0.5em] text-[9px]">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group active">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            <a href="#"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kelola User
            </a>

            <div class="pt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-500/10 transition-all group">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-10 relative">
        <header id="top-bar" class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] mb-1">Status Sistem: Aktif</h2>
                <h3 class="text-xl font-bold text-white">Halo, {{ auth()->user()->name }} 👋</h3>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-xs font-bold">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <div id="content-area">
            @yield('content')
        </div>
    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tl = gsap.timeline({ defaults: { ease: "power4.out", duration: 1 } });
        
        tl.from("#sidebar", { xPercent: -100, duration: 1.2 })
          .from("#top-bar", { y: -30, opacity: 0 }, "-=0.8")
          .from("#content-area", { y: 20, opacity: 0 }, "-=0.6");
    });
</script>
</body>
</html>