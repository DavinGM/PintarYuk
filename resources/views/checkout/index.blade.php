@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-32 pb-20 bg-slate-950 relative overflow-hidden">

        {{-- Background Aesthetic --}}
        <div
            class="absolute top-0 left-0 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto px-6">

            <div class="mb-10 text-center">
                <h1 class="text-4xl font-black text-white uppercase tracking-tight">Checkout</h1>
                <p class="text-slate-400 mt-2">Selesaikan pembayaran Anda untuk mengakses buku.</p>
            </div>

            <div class="grid lg:grid-cols-12 gap-10">

                {{-- Left: Order Items --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="bg-slate-900/40 backdrop-blur-md border border-white/5 rounded-[2rem] p-8">
                        <h3 class="text-xl font-bold text-white mb-6">Item Pesanan</h3>

                        <div class="space-y-6">
                            @foreach($items as $item)
                                <div class="flex gap-4">
                                    <div class="w-20 h-28 bg-slate-800 rounded-xl overflow-hidden shadow-md flex-shrink-0">
                                        <img src="{{ $item->book->cover }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-bold leading-tight">{{ $item->book->title }}</h4>
                                        <p class="text-slate-500 text-sm mt-1">{{ $item->book->author }}</p>
                                        <div class="flex justify-between items-end mt-2">
                                            <span class="text-slate-400 text-sm">x{{ $item->qty }}</span>
                                            <span
                                                class="text-white font-bold">{{ number_format($item->book->final_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                <div class="h-px bg-white/5"></div> @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Billing Info (Static for now) --}}
                    <div class="bg-slate-900/40 backdrop-blur-md border border-white/5 rounded-[2rem] p-8">
                        <h3 class="text-xl font-bold text-white mb-6">Informasi Pembeli</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Nama</label>
                                <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                            </div>
                            <div>
                                <label
                                    class="block text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Email</label>
                                <div class="text-white font-medium">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Summary & Pay --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-32 space-y-6">
                        <div
                            class="bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden">

                            {{-- Decorative --}}
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-blue-500/20 blur-[60px] rounded-full pointer-events-none">
                            </div>

                            <h3 class="text-xl font-bold text-white mb-6">Ringkasan Pembayaran</h3>

                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Subtotal Produk</span>
                                    <span class="font-bold text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Biaya Layanan</span>
                                    <span class="font-bold text-white">Rp 0</span>
                                </div>
                                <div class="h-px bg-white/10 my-4"></div>
                                <div class="flex justify-between items-end">
                                    <span class="text-slate-300 font-bold">Total Tagihan</span>
                                    <span class="text-4xl font-black text-white tracking-tighter">Rp
                                        {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button id="pay-button"
                                class="w-full py-5 bg-blue-600 hover:bg-blue-500 text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-600/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3">
                                <span>Bayar Sekarang</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </button>

                            <p class="text-xs text-center text-slate-500 mt-4 leading-relaxed">
                                Dilindungi oleh Midtrans Payment Gateway. <br> Transaksi aman dan terenkripsi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Midtrans Snap.js --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', async function () {
            const btn = this;
            const originalContent = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<svg class="w-6 h-6 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

            try {
                // 1. Get Snap Token from Backend
                const response = await fetch("{{ route('checkout.process') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                });

                const data = await response.json();

                if (data.status === 'success') {
                    // 2. Open Snap Popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            alert("Pembayaran Berhasil! Mengalihkan...");
                            window.location.href = "{{ route('orders.index') }}";
                        },
                        onPending: function (result) {
                            alert("Menunggu Pembayaran...");
                            window.location.href = "{{ route('orders.index') }}";
                        },
                        onError: function (result) {
                            alert("Pembayaran Gagal!");
                            window.location.href = "{{ route('orders.index') }}";
                        },
                        onClose: function () {
                            alert('Anda menutup popup pembayaran.');
                            window.location.href = "{{ route('orders.index') }}";
                        }
                    });
                } else {
                    alert('Gagal memproses order: ' + data.message);
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                }

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan sistem.');
                btn.disabled = false;
                btn.innerHTML = originalContent;
            }
        });
    </script>
@endsection