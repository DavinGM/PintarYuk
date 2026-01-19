@extends('layouts.app')

@section('content')
<div id="category-page" class="bg-[#020617] min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- 1. Hero Section (Branding & Search) --}}
        @include('category._HeroSection')

        {{-- 2. Bento Grid Categories (Navigasi Genre - POSISI PALING ATAS) --}}
        @include('category._CategoryGrid')

        {{-- 3. Book Section (List 8 Buku per Kategori dengan Pagination) --}}
        @include('category._BookSection')
        
    </div>
</div>
@endsection
@push('scripts')
<script>
function applyBookmarkStyle(btn, active) {
    // RESET
    btn.style.backgroundColor = 'transparent';
    btn.style.color = '#94a3b8';
    btn.style.boxShadow = 'none';

    if (active) {
        btn.style.backgroundColor = '#facc15';
        btn.style.color = '#020617';
        btn.style.boxShadow = '0 0 0 2px rgba(250,204,21,.6)';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        const active = btn.dataset.bookmarked === '1';
        applyBookmarkStyle(btn, active);
    });
});

document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.bookmark-btn');
    if (!btn) return;

    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrf) return alert('Login dulu');

    btn.disabled = true;

    try {
        const res = await fetch('/bookmark/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                book_id: btn.dataset.bookId,
            }),
        });

        const data = await res.json();

        // 🔥 SUMBER KEBENARAN SATU-SATUNYA
        const isActive = data.status === 'added';

        // UPDATE STATE
        btn.dataset.bookmarked = isActive ? '1' : '0';

        // UPDATE UI LANGSUNG
        applyBookmarkStyle(btn, isActive);

    } catch (e) {
        console.error(e);
    } finally {
        btn.disabled = false;
    }
});
</script>

@endpush
