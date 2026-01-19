@extends('layouts.app')

@section('content')
    <div class="bg-slate-950 min-h-screen relative overflow-hidden">

        {{-- Ambient Background --}}
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 pt-32 pb-24">

            {{-- Hero Header --}}
            <div class="text-center mb-20">
                <span
                    class="inline-block px-4 py-1.5 rounded-full border border-blue-500/30 bg-blue-500/5 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md">
                    Limited Time Offers
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-blue-100 to-slate-400">
                        Events & Promo
                    </span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                    Jelajahi penawaran eksklusif dan klaim voucher spesial untuk menambah koleksi bacaan Anda minggu ini.
                </p>
            </div>

            {{-- Events List (Editorial Layout) --}}
            <div class="space-y-16 md:space-y-32">
                @forelse($events as $index => $event)
                    <div class="group relative grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                        {{-- Decorative Line --}}
                        <div
                            class="hidden md:block absolute left-1/2 -translate-x-1/2 w-px h-full bg-gradient-to-b from-transparent via-white/10 to-transparent -z-10">
                        </div>

                        {{-- Image Side --}}
                        <div class="md:col-span-7 {{ $index % 2 === 0 ? 'md:order-1' : 'md:order-2' }}">
                            <div
                                class="relative aspect-[16/9] rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl group-hover:shadow-blue-500/20 transition-all duration-500">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent z-10">
                                </div>
                                <img src="{{ $event->image ?? 'https://via.placeholder.com/800x450' }}"
                                    alt="{{ $event->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">

                                @if($event->voucher)
                                    <div class="absolute bottom-6 left-6 z-20">
                                        <div
                                            class="flex items-center gap-3 bg-slate-950/50 backdrop-blur-md border border-white/10 rounded-xl p-2 pr-4">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                                                %
                                            </div>
                                            <div>
                                                <p class="text-xs text-slate-300 uppercase font-bold">Voucher Available</p>
                                                <p class="text-sm font-bold text-white">{{ $event->voucher->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Content Side --}}
                        <div
                            class="md:col-span-5 {{ $index % 2 === 0 ? 'md:order-2 md:pl-12' : 'md:order-1 md:pr-12 md:text-right' }}">
                            <h2
                                class="text-3xl md:text-4xl font-black text-white mb-6 leading-tight group-hover:text-blue-400 transition-colors">
                                {{ $event->title }}
                            </h2>

                            <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                                {{ $event->description }}
                            </p>

                            {{-- Action Area --}}
                            @if($event->voucher)
                                <div class="{{ $index % 2 === 0 ? '' : 'md:flex md:justify-end' }}" x-data="{ 
                                                loading: false, 
                                                claimed: {{ Auth::user() && Auth::user()->vouchers->contains($event->voucher_id) ? 'true' : 'false' }},
                                                async claim(id) {
                                                    this.loading = true;
                                                    try {
                                                        const res = await fetch(`/events/${id}/claim`, {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'Accept': 'application/json',
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                            }
                                                        });
                                                        const data = await res.json();
                                                        if (res.ok) {
                                                            this.claimed = true;
                                                            // Enhance UI feedback could be better than alert, but alert for now
                                                        }
                                                    } catch (e) {
                                                        console.error(e);
                                                    } finally {
                                                        this.loading = false;
                                                    }
                                                }
                                            }">
                                    <button @click="claim({{ $event->id }})" :disabled="loading || claimed"
                                        class="relative group/btn overflow-hidden px-8 py-4 rounded-2xl font-bold text-white transition-all duration-300 transform hover:-translate-y-1 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                        :class="claimed ? 'bg-slate-800 text-emerald-400 border border-emerald-500/30' : 'bg-white text-slate-950 hover:bg-blue-400 hover:text-white'">

                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300 -z-10"
                                            x-show="!claimed"></div>

                                        <div class="flex items-center gap-3">
                                            <template x-if="loading">
                                                <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                        stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                            </template>
                                            <template x-if="claimed">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </template>

                                            <span
                                                x-text="claimed ? 'Klaim Berhasil' : (loading ? 'Memproses...' : 'Klaim Voucher')"></span>
                                        </div>
                                    </button>
                                    <p class="mt-3 text-sm text-slate-500 font-medium" x-show="claimed">Voucher aktif di keranjang
                                        Anda</p>
                                </div>
                            @else
                                <div
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 border border-white/5 text-slate-500 font-bold">
                                    <span>Event Info Only</span>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="text-center py-32">
                        <div class="w-24 h-24 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">No Active Events</h3>
                        <p class="text-slate-400">Stay tuned for upcoming promotions.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection