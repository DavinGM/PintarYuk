<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $vouchers = $user->vouchers()
            ->orderByPivot('claimed_at', 'desc')
            ->get()
            ->map(function ($voucher) {
                // Add status helper
                $isExpired = $voucher->pivot->expires_at && now()->gt($voucher->pivot->expires_at);
                $isGlobalExpired = now()->gt($voucher->expiry_date);

                $voucher->status_label = 'Aktif';
                $voucher->status_color = 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20';

                if ($voucher->pivot->is_used) {
                    $voucher->status_label = 'Terpakai';
                    $voucher->status_color = 'bg-slate-800 text-slate-400 border-white/5';
                } elseif ($isExpired || $isGlobalExpired) {
                    $voucher->status_label = 'Kadaluarsa';
                    $voucher->status_color = 'bg-red-500/10 text-red-400 border-red-500/20';
                }

                return $voucher;
            });

        return view('pages.vouchers.index', compact('vouchers'));
    }
}
