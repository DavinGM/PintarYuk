@extends('layouts.app')

@section('content')
    <div class="bg-slate-950 min-h-screen pt-24 pb-12">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-white mb-2">Voucher Saya</h1>
                <p class="text-slate-400">Kelola dan gunakan voucher yang telah Anda klaim.</p>
            </div>

            {{-- Vouchers List --}}
            <div class="space-y-4">
                @forelse($vouchers as $voucher)
                    <div
                        class="relative group bg-slate-900 border border-white/5 rounded-2xl p-6 overflow-hidden hover:border-blue-500/30 transition-all flex flex-col md:flex-row gap-6">

                        {{-- Decorative Circle --}}
                        <div
                            class="absolute -right-12 -top-12 w-32 h-32 bg-blue-600/5 rounded-full blur-2xl group-hover:bg-blue-600/10 transition-all">
                        </div>

                        {{-- Left: Icon & Code --}}
                        <div
                            class="flex-shrink-0 flex items-center justify-center w-full md:w-24 bg-slate-950 rounded-xl border border-white/5 border-dashed">
                            @if($voucher->type === 'percentage')
                                <span class="text-2xl font-black text-blue-500">{{ $voucher->reward_amount }}%</span>
                            @else
                                <div class="text-center">
                                    <span class="block text-xs text-slate-500 uppercase">Hemat</span>
                                    <span
                                        class="text-lg font-black text-blue-500">{{ number_format($voucher->reward_amount / 1000, 0) }}K</span>
                                </div>
                            @endif
                        </div>

                        {{-- Middle: Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h3 class="text-lg font-bold text-white truncate">{{ $voucher->title }}</h3>
                                <span
                                    class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-bold border {{ $voucher->status_color }}">
                                    {{ $voucher->status_label }}
                                </span>
                            </div>

                            <p class="text-slate-400 text-sm mb-4">
                                Min. Belanja {{ 'Rp ' . number_format($voucher->min_spend, 0, ',', '.') }}
                            </p>

                            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Berlaku s.d.
                                        {{ \Carbon\Carbon::parse($voucher->pivot->expires_at ?? $voucher->expiry_date)->format('d M Y H:i') }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-1 px-2 py-1 bg-slate-800 rounded-md select-all font-mono text-slate-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>{{ $voucher->code }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Action --}}
                        <div class="flex items-center">
                            @if($voucher->status_label === 'Aktif')
                                <a href="{{ route('cart.index') }}"
                                    class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-colors text-sm text-center">
                                    Pakai
                                </a>
                            @else
                                <button disabled
                                    class="w-full md:w-auto px-6 py-3 bg-slate-800 text-slate-500 font-bold rounded-xl cursor-not-allowed text-sm">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="text-center py-20 bg-slate-900/40 rounded-3xl border border-white/5">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800 mb-6 text-slate-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Belum Ada Voucher</h3>
                        <p class="text-slate-400 mb-8">Ikuti event kami untuk mendapatkan penawaran menarik.</p>
                        <a href="{{ route('events.index') }}"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-colors">
                            Lihat Event
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection