<nav id="main-nav" x-data="{ open: false }"
    class="fixed top-0 w-full z-[100] border-b border-white/5 bg-slate-950/70 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <div class="flex items-center gap-2 group" id="nav-logo">
            <a href="/" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300 shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-white uppercase italic">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-400" id="nav-links">
            <a href="/jelajah" class="hover:text-blue-400 transition-colors">jelajahi</a>
            <a href="/category" class="hover:text-blue-400 transition-colors">Kategori</a>
            <a href="#" class="hover:text-blue-400 transition-colors">Promo</a>
        </div>

        <div class="flex items-center gap-4" id="nav-auth">
            @auth
                <a href="{{ route('cart.index') }}"
                    class="relative group p-2 text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->first()?->items->sum('qty') ?? 0;
                    @endphp
                    @if($cartCount > 0)
                        <span
                            class="absolute top-0 right-0 w-4 h-4 bg-blue-600 text-[9px] font-black text-white flex items-center justify-center rounded-full shadow-lg shadow-blue-600/50">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 text-slate-300 hover:text-white py-2 px-4 rounded-lg hover:bg-white/5 transition-all">
                            <span class="font-bold text-sm">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}"
                    class="text-slate-400 font-bold text-sm hover:text-white transition-colors">Masuk</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/25 transition-all active:scale-95">Mulai</a>
            @endauth

            <button @click="open = ! open" class="md:hidden text-slate-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition class="md:hidden bg-slate-900 border-t border-white/5 px-6 py-6 space-y-4">
        <a href="/jelajah" class="block text-slate-300 font-bold">jelajahi</a>
        <a href="/category" class="block text-slate-300 font-bold">Kategori</a>
        @auth <a href="{{ route('profile.edit') }}" class="block text-slate-300 font-bold">Profile</a> @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navTl = gsap.timeline({ defaults: { ease: "expo.out", duration: 1.2 } });
        navTl.from("#main-nav", { yPercent: -100 })
            .from("#nav-logo", { opacity: 0, x: -20 }, "-=0.8")
            .from("#nav-links a", { opacity: 0, y: -10, stagger: 0.1 }, "-=1")
            .from("#nav-auth", { opacity: 0, x: 20 }, "-=1.2");
    });

</script>