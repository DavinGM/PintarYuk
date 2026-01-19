@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] mt-20 flex items-center justify-center px-6">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:40px_40px] opacity-20 -z-10"></div>

    <div id="login-box" class="w-full max-w-[380px]">
        <div class="mb-8 overflow-hidden text-center lg:text-left">
            <h1 id="t-1" class="text-2xl font-bold tracking-tight text-white/90 font-[Figtree]">Akses Belajar.</h1>
            <p id="t-2" class="text-slate-500 text-sm mt-1">Masuk untuk melanjutkan literasi Anda.</p>
        </div>

        <div class="field-item grid grid-cols-2 gap-3 mb-6">
            <a href="/auth/google" class="flex items-center justify-center gap-2 bg-slate-900 border border-slate-800 hover:border-slate-600 py-2.5 rounded-lg transition-all group">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="Google">
                <span class="text-[10px] font-black text-slate-400 group-hover:text-white tracking-widest uppercase">Google</span>
            </a>
            <a href="/auth/github" class="flex items-center justify-center gap-2 bg-gray-900 border border-gray-800 hover:border-gray-600 py-2.5 rounded-lg">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.79-.26.79-.58v-2.23c-3.34.73-4.03-1.42-4.03-1.42-.55-1.38-1.33-1.76-1.33-1.76-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.23 1.84 1.23 1.07 1.83 2.81 1.3 3.49 1 .11-.77.42-1.3.76-1.6-2.66-.3-5.46-1.33-5.46-5.93 0-1.31.47-2.38 1.23-3.22-.12-.3-.53-1.52.12-3.18 0 0 1-.32 3.3 1.23.96-.27 1.98-.4 3-.4 1.02.01 2.05.13 3 .4 2.3-1.55 3.3-1.23 3.3-1.23.65 1.65.24 2.87.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.63-5.48 5.93.43.37.82 1.1.82 2.22v3.29c0 .32.19.69.8.58 4.76-1.59 8.2-6.09 8.2-11.39 0-6.63-5.37-12-12-12z"/>
                </svg>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">GitHub</span>
            </a>

        </div>

        <div class="field-item flex items-center gap-4 mb-6">
            <div class="h-[1px] bg-slate-800 flex-1"></div>
            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.3em]">Atau</span>
            <div class="h-[1px] bg-slate-800 flex-1"></div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div class="field-item">
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                    placeholder="Email">
            </div>

            <div class="field-item">
                <input type="password" name="password" required
                    class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                    placeholder="Password">
            </div>

            <div class="field-item flex items-center justify-between pt-1">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-3 h-3 rounded bg-slate-900 border-slate-800 text-blue-600 focus:ring-0 transition-all">
                    <span class="ml-2 text-[10px] text-slate-500 group-hover:text-slate-300 font-bold tracking-widest uppercase transition-colors">Ingat</span>
                </label>
                <a href="#" class="text-[10px] font-bold text-slate-600 hover:text-blue-400 tracking-widest uppercase transition-colors">Lupa?</a>
            </div>

            <div class="field-item pt-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black py-4 rounded-lg transition-all tracking-[0.2em] active:scale-[0.97] shadow-lg shadow-blue-600/10">
                    MASUK SEKARANG
                </button>
            </div>
        </form>

        <div id="t-3" class="mt-8 pt-6 border-t border-slate-900/50 text-center">
            <p class="text-[10px] text-slate-600 font-bold uppercase tracking-widest">
                Baru di sini? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-white transition-colors ml-1">Buat Akun</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tl = gsap.timeline({ defaults: { ease: "expo.out", duration: 1.2 } });
        tl.from("#login-box", { y: 30, opacity: 0 })
          .from("#t-1, #t-2", { y: 15, opacity: 0, stagger: 0.1 }, "-=0.8")
          .from(".field-item", { y: 10, opacity: 0, stagger: 0.05 }, "-=0.8");
    });
</script>
@endpush