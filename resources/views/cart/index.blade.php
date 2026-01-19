@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-24 pb-20 bg-slate-950 relative overflow-hidden" x-data="cartLogic(
                    @js($cart ? $cart->items->load('book') : []),
                    @js($cart->voucher_id ?? null),
                    @js($vouchers)
                )">

        {{-- Background Aesthetic --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-10">
                <h1 class="text-3xl font-black text-white uppercase tracking-tight">Keranjang <span
                        class="text-blue-500">Belanja</span></h1>
                <p class="text-slate-400 mt-2">Kelola buku pilihan Anda sebelum checkout.</p>
            </div>

            <template x-if="items.length === 0">
                <div
                    class="flex flex-col items-center justify-center py-24 border-2 border-dashed border-white/5 rounded-[3rem] bg-slate-900/10">
                    <div
                        class="w-24 h-24 bg-slate-900 border border-white/5 rounded-3xl flex items-center justify-center mb-6 shadow-2xl">
                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-white text-xl font-bold mb-2">Keranjang Kosong</h3>
                    <p class="text-slate-500 mb-8">Anda belum menambahkan buku apapun.</p>
                    <a href="{{ route('jelajah') }}"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                        Mulai Belanja
                    </a>
                </div>
            </template>

            <div x-show="items.length > 0" class="flex flex-col lg:flex-row gap-8" style="display: none;">

                {{-- Left Column: Items --}}
                <div class="flex-1 space-y-4">

                    {{-- Header / Tools --}}
                    <div
                        class="bg-slate-900/40 backdrop-blur-md border border-white/5 rounded-2xl p-4 flex items-center justify-between">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox"
                                class="w-5 h-5 rounded-lg bg-slate-800 border-slate-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900 transition-all"
                                x-model="selectAll" @change="toggleAll">
                            <span class="text-sm font-bold text-slate-300 group-hover:text-white transition-colors">Pilih
                                Semua</span>
                        </label>
                        <button @click="removeSelected" x-show="selected.length > 0"
                            class="text-red-400 text-xs font-bold hover:text-red-300 uppercase tracking-widest transition-colors">
                            Hapus Dipilih
                        </button>
                    </div>

                    {{-- Item List --}}
                    <template x-for="item in items" :key="item.id">
                        <div class="group relative bg-slate-900/40 backdrop-blur-md border border-white/5 rounded-[2rem] p-4 transition-all hover:bg-slate-900/60 hover:border-blue-500/20"
                            :class="{'border-blue-500/40 bg-blue-900/5': selected.includes(item.id)}">

                            <div class="flex gap-5">
                                {{-- Checkbox --}}
                                <div class="flex items-center pl-2">
                                    <input type="checkbox" :value="item.id" x-model="selected"
                                        class="w-5 h-5 rounded-lg bg-slate-800 border-slate-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900 transition-all">
                                </div>

                                {{-- Image --}}
                                <div class="w-24 h-32 flex-shrink-0 bg-slate-800 rounded-2xl overflow-hidden shadow-md">
                                    <img :src="item.book.cover" class="w-full h-full object-cover">
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 py-1 flex flex-col justify-between">
                                    <div>
                                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1"
                                            x-text="item.book.author"></p>
                                        <a :href="'/book/' + item.book.slug"
                                            class="text-white font-bold text-lg leading-tight hover:underline line-clamp-2"
                                            x-text="item.book.title"></a>
                                    </div>

                                    <div class="flex items-end justify-between">
                                        <div class="text-white font-black text-xl" x-text="formatRupiah(item.book.price)">
                                        </div>

                                        {{-- Qty Control --}}
                                        <div
                                            class="flex items-center gap-3 bg-slate-950/50 rounded-xl p-1 border border-white/5">
                                            <button @click="updateQty(item.id, -1)"
                                                class="w-8 h-8 flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition-colors disabled:opacity-50"
                                                :disabled="item.qty <= 1">
                                                -
                                            </button>
                                            <span class="w-8 text-center font-bold text-white text-sm"
                                                x-text="item.qty"></span>
                                            <button @click="updateQty(item.id, 1)"
                                                class="w-8 h-8 flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition-colors">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Remove Btn --}}
                                <button @click="removeItem(item.id)"
                                    class="absolute top-4 right-4 text-slate-500 hover:text-red-500 p-2 rounded-lg hover:bg-red-500/10 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Right Column: Summary (Sticky) --}}
                <div class="lg:w-96 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">

                        <div
                            class="bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 shadow-2xl">
                            <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                                <span class="w-1 h-6 bg-blue-500 rounded-full"></span>
                                Ringkasan Belanja
                            </h3>

                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Total Item</span>
                                    <span class="font-bold text-white" x-text="itemsCount + ' item'"></span>
                                </div>
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-white" x-text="formatRupiah(subtotal)"></span>
                                </div>

                                <template x-if="selected.length > 0">
                                    <div class="flex justify-between text-blue-400 text-sm">
                                        <span>Estimasi Diskon</span>
                                        <span class="font-bold" x-text="'-' + formatRupiah(discount)"></span>
                                    </div>
                                </template>

                                <div class="h-px bg-white/10 my-4"></div>

                                <div class="flex justify-between items-end">
                                    <span class="text-slate-300 font-bold">Total Bayar</span>
                                    <span class="text-3xl font-black text-white tracking-tighter"
                                        x-text="formatRupiah(total)"></span>
                                </div>
                            </div>

                            <button @click="goToCheckout"
                                class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-600/30 transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="selected.length === 0">
                                <span>Checkout</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>

                            <p class="text-xs text-center text-slate-500 mt-4 leading-relaxed">
                                Dengan checkout, Anda menyetujui <a href="#" class="text-blue-500 hover:underline">S&K</a>
                                kami. <br> Pengiriman instan via email.
                            </p>
                        </div>

                        {{-- Promo Code --}}
                        {{-- Voucher Selection --}}
                        <div class="bg-slate-900/40 border border-white/5 rounded-3xl p-6">
                            <h4 class="text-sm font-bold text-white mb-3">Pilih Voucher</h4>

                            <template x-if="vouchers.length === 0">
                                <p class="text-slate-500 text-xs">Anda belum memiliki voucher. <a
                                        href="{{ route('events.index') }}" class="text-blue-500 hover:underline">Lihat
                                        Event</a></p>
                            </template>

                            <template x-if="vouchers.length > 0">
                                <div class="space-y-4">
                                    {{-- Custom Dropdown --}}
                                    <div class="relative" x-data="{ open: false }">
                                        
                                        {{-- Trigger --}}
                                        <button @click="open = !open" @click.away="open = false"
                                            class="w-full bg-slate-950 border border-slate-700/50 rounded-xl px-4 py-3 flex items-center justify-between text-left hover:border-blue-500/50 transition-colors focus:ring-2 focus:ring-blue-500/20">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                                </div>
                                                <div>
                                                    <span class="block text-sm font-bold text-white" x-text="selectedVoucher ? selectedVoucher.title : 'Pilih Voucher'"></span>
                                                    <span class="block text-xs text-slate-500" x-text="selectedVoucher ? selectedVoucher.code : 'Hemat dengan voucher'"></span>
                                                </div>
                                            </div>
                                            <svg class="w-5 h-5 text-slate-500 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>

                                        {{-- Menu --}}
                                        <div x-show="open" 
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 translate-y-2"
                                             class="absolute bottom-full left-0 right-0 mb-2 bg-slate-900 border border-white/10 rounded-xl shadow-2xl z-50 overflow-hidden max-h-60 overflow-y-auto">
                                            
                                            <div class="p-2 space-y-1">
                                                <template x-for="voucher in vouchers" :key="voucher.id">
                                                    <button @click="applyVoucher(voucher.id); open = false"
                                                        class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-white/5 transition-colors group text-left"
                                                        :class="{'bg-blue-500/10': voucherId == voucher.id}">
                                                        
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold"
                                                                :class="voucherId == voucher.id ? 'bg-blue-500 text-white' : 'bg-slate-800 text-slate-400'">
                                                                %
                                                            </div>
                                                            <div>
                                                                <p class="text-sm font-bold text-white group-hover:text-blue-400" x-text="voucher.title"></p>
                                                                <p class="text-xs text-slate-400" x-text="voucher.code"></p>
                                                            </div>
                                                        </div>
                                                        
                                                        <span class="text-xs font-bold px-2 py-1 rounded bg-slate-950 text-emerald-400 border border-emerald-500/20"
                                                            x-text="voucher.type === 'percentage' ? voucher.reward_amount + '%' : formatRupiah(voucher.reward_amount)"></span>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Selected Voucher Info (Keep existing remove button logic but clearer) --}}
                                    <template x-if="selectedVoucher">
                                        <div class="flex justify-end">
                                             <button @click="applyVoucher(null)" class="text-xs text-red-400 hover:text-red-300 font-bold hover:underline">
                                                Lepas Voucher
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function cartLogic(initialItems, initialVoucherId, availableVouchers) {
                return {
                    items: initialItems,
                    selected: [],
                    selectAll: false,
                    voucherId: initialVoucherId,
                    vouchers: availableVouchers,

                    init() {
                        this.selected = this.items.map(i => i.id); // Auto select all initially
                        this.selectAll = true;
                    },

                    get itemsCount() {
                        // Ensure ID comparison is type-safe
                        return this.items.filter(i => this.selected.map(String).includes(String(i.id))).reduce((acc, i) => acc + i.qty, 0);
                    },

                    get subtotal() {
                        return this.items
                            .filter(i => this.selected.map(String).includes(String(i.id)))
                            .reduce((acc, i) => acc + (Number(i.book.final_price || i.book.price) * i.qty), 0);
                    },

                    get selectedVoucher() {
                        return this.vouchers.find(v => v.id == this.voucherId);
                    },

                    get discount() {
                        const voucher = this.selectedVoucher;
                        if (!voucher) return 0;

                        if (this.subtotal < voucher.min_spend) return 0;

                        if (voucher.type === 'percentage') {
                            return this.subtotal * (voucher.reward_amount / 100);
                        }
                        return Math.min(Number(voucher.reward_amount), this.subtotal);
                    },

                    get total() {
                        return Math.max(0, this.subtotal - this.discount);
                    },

                    toggleAll() {
                        this.selected = this.selectAll ? this.items.map(i => i.id) : [];
                    },

                    formatRupiah(angka) {
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
                    },

                    async applyVoucher(id) {
                        this.voucherId = id;
                        try {
                            await fetch("{{ route('cart.apply_voucher') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({ voucher_id: id })
                            });
                        } catch (e) {
                            console.error('Failed to apply voucher', e);
                        }
                    },

                    goToCheckout() {
                        if (this.selected.length === 0) return;
                        // Ideally pass selected items to backend, but for now we proceed to checkout page
                        // We might need to store selected IDs in session or passes via query param if partial checkout is needed.
                        // For this iteration, we assume full cart checkout or we rely on the backend to filter (not implemented yet).
                        // Let's forward to checkout.
                        window.location.href = "{{ route('checkout.index') }}";
                    },

                    async updateQty(id, delta) {
                        const item = this.items.find(i => i.id === id);
                        if (!item) return;

                        const newQty = item.qty + delta;
                        if (newQty < 1) return;

                        item.qty = newQty; // Optimistic update

                        try {
                            await fetch("{{ route('cart.update') }}", {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({ item_id: id, qty: newQty })
                            });
                        } catch (e) {
                            console.error(e);
                            item.qty -= delta; // Revert
                        }
                    },

                    async removeItem(id) {
                        if (!confirm('Hapus buku ini dari keranjang?')) return;

                        // Optimistic remove
                        const index = this.items.findIndex(i => i.id === id);
                        const removedItem = this.items[index];
                        this.items = this.items.filter(i => i.id !== id);
                        this.selected = this.selected.filter(sid => sid !== id);

                        try {
                            await fetch(`/cart/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                }
                            });
                        } catch (e) {
                            console.error(e);
                            this.items.splice(index, 0, removedItem); // Revert
                        }
                    },

                    async removeSelected() {
                        // Implement bulk delete if needed
                    }
                }
            }
        </script>
    @endpush
@endsection