@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-32 pb-20 bg-slate-950 relative overflow-hidden">

        <div
            class="absolute top-0 left-0 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-white uppercase tracking-tight">Riwayat <span
                            class="text-blue-500">Pesanan</span></h1>
                    <p class="text-slate-400 mt-2">Pantau status pembayaran dan koleksi buku Anda.</p>
                </div>
                <a href="{{ route('jelajah') }}"
                    class="px-6 py-2 bg-white/5 border border-white/10 rounded-xl text-white text-sm font-bold hover:bg-white/10 transition-colors">
                    Belanja Lagi
                </a>
            </div>

            <div class="space-y-6">
                @forelse($orders as $order)
                        <div
                            class="bg-slate-900/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 overflow-hidden relative group">

                            {{-- Status Indicator Strip --}}
                            <div class="absolute left-0 top-0 bottom-0 w-1 
                                {{ $order->payment_status == 'settlement' || $order->payment_status == 'success' ? 'bg-green-500' :
                    ($order->payment_status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            </div>

                            <div class="flex flex-col md:flex-row gap-6">
                                {{-- Header Info --}}
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span
                                            class="text-xs font-mono text-slate-500 bg-slate-950 px-2 py-1 rounded border border-white/5">
                                            #{{ $order->number }}
                                        </span>
                                        <span class="text-slate-400 text-xs font-medium">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-16 bg-slate-800 rounded-lg overflow-hidden flex-shrink-0">
                                                    <img src="{{ $item->book->cover }}" class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <h4 class="text-white font-bold text-sm leading-tight">{{ $item->book->title }}</h4>
                                                    <p class="text-slate-500 text-xs">{{ $item->qty }} x Rp
                                                        {{ number_format($item->book->final_price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Actions & Status --}}
                                <div
                                    class="md:w-64 flex flex-col justify-between border-t md:border-t-0 md:border-l border-white/5 md:pl-6 pt-6 md:pt-0">
                                    <div>
                                        <span class="block text-slate-500 text-xs uppercase tracking-widest mb-1">Total
                                            Tagihan</span>
                                        <span class="block text-2xl font-black text-white">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="mt-6">
                                        @if($order->payment_status == 'pending')
                                            <button onclick="payNow('{{ $order->snap_token }}')"
                                                class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-95 flex items-center justify-center gap-2">
                                                <span>Bayar Sekarang</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>
                                            <p class="text-[10px] text-yellow-500 mt-2 text-center font-medium">Menunggu Pembayaran</p>
                                        @elseif($order->payment_status == 'settlement' || $order->payment_status == 'success')
                                            <div
                                                class="w-full py-3 bg-green-500/10 border border-green-500/20 text-green-400 font-bold rounded-xl text-center">
                                                Lunas
                                            </div>
                                        @else
                                            <div
                                                class="w-full py-3 bg-red-500/10 border border-red-500/20 text-red-400 font-bold rounded-xl text-center">
                                                Gagal / Kadaluarsa
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                @empty
                    <div class="text-center py-20">
                        <div
                            class="w-20 h-20 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-6 border border-white/5">
                            <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-lg">Belum ada pesanan</h3>
                        <p class="text-slate-500">Mulai belanja buku favoritmu sekarang!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        function payNow(snapToken) {
            if (!snapToken) {
                alert('Error: Token tidak valid');
                return;
            }

            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    alert("Pembayaran Berhasil!");
                    window.location.reload();
                },
                onPending: function (result) {
                    alert("Menunggu Pembayaran...");
                    window.location.reload();
                },
                onError: function (result) {
                    alert("Pembayaran Gagal!");
                    window.location.reload();
                },
                onClose: function () {
                    // Do nothing
                }
            });
        }
    </script>
@endsection