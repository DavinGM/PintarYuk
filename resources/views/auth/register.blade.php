@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] mt-20 flex items-center justify-center px-6 pb-12">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:40px_40px] opacity-20 -z-10"></div>

    <div id="register-box" class="w-full max-w-[420px]">
        <div class="mb-8 overflow-hidden text-center lg:text-left">
            <h1 id="r-1" class="text-2xl font-bold tracking-tight text-white/90">Bergabung.</h1>
            <p id="r-2" class="text-slate-500 text-sm mt-1">Mulai perjalanan literasi digital Anda hari ini.</p>
        </div>

        <div class="field-item grid grid-cols-2 gap-3 mb-6">
            <a href="#" class="flex items-center justify-center gap-2 bg-slate-900 border border-slate-800 hover:border-slate-600 py-2.5 rounded-lg transition-all group">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="Google">
                <span class="text-[10px] font-black text-slate-400 group-hover:text-white tracking-[0.15em] uppercase">Google</span>
            </a>
            <a href="#" class="flex items-center justify-center gap-2 bg-slate-900 border border-slate-800 hover:border-slate-600 py-2.5 rounded-lg transition-all group">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                <span class="text-[10px] font-black text-slate-400 group-hover:text-white tracking-[0.15em] uppercase">GitHub</span>
            </a>
        </div>

        <div class="field-item flex items-center gap-4 mb-6 text-slate-800">
            <div class="h-[1px] bg-current flex-1"></div>
            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.3em]">Identity</span>
            <div class="h-[1px] bg-current flex-1"></div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="field-item">
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                    placeholder="Nama Lengkap">
                @if($errors->has('name'))
                    <span class="text-[10px] text-red-500 mt-1 block uppercase font-bold">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="field-item">
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                    placeholder="Alamat Email">
                @if($errors->has('email'))
                    <span class="text-[10px] text-red-500 mt-1 block uppercase font-bold">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="field-item grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <input type="password" name="password" required
                        class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                        placeholder="Password">
                </div>
                <div>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500/50 transition-all"
                        placeholder="Konfirmasi">
                </div>
            </div>
            @if($errors->has('password'))
                <span class="field-item text-[10px] text-red-500 mt-1 block uppercase font-bold">{{ $errors->first('password') }}</span>
            @endif

            <div class="field-item pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black py-4 rounded-lg transition-all tracking-[0.2em] active:scale-[0.97] shadow-lg shadow-blue-600/10 uppercase">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div id="r-3" class="mt-8 pt-6 border-t border-slate-900 text-center">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-white transition-colors ml-1 uppercase">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tl = gsap.timeline({ defaults: { ease: "expo.out", duration: 1.2 } });

        tl.from("#register-box", { y: 30, opacity: 0 })
          .from("#r-1, #r-2", { y: 15, opacity: 0, stagger: 0.1 }, "-=0.8")
          .from(".field-item", { y: 10, opacity: 0, stagger: 0.05 }, "-=0.8")
          .from("#r-3", { opacity: 0 }, "-=0.5");
    });
</script>
@endpush