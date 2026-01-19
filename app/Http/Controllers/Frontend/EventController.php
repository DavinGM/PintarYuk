<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('voucher')->where('is_active', true)->latest()->get();
        return view('pages.events.index', compact('events'));
    }

    public function claimVoucher(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $voucher = $event->voucher;

        if (!$voucher) {
            return back()->with('error', 'Event tidak memiliki voucher.');
        }

        $user = Auth::user();

        // Check if user already has this voucher
        $existingClaim = DB::table('user_vouchers')
            ->where('user_id', $user->id)
            ->where('voucher_id', $voucher->id)
            ->exists();

        if ($existingClaim) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Anda sudah mengklaim voucher ini.'], 400);
            }
            return back()->with('error', 'Anda sudah mengklaim voucher ini.');
        }

        // Check global limit
        $currentClaims = DB::table('user_vouchers')->where('voucher_id', $voucher->id)->count();
        if ($currentClaims >= $voucher->limit_usage) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Kuota voucher sudah habis.'], 400);
            }
            return back()->with('error', 'Kuota voucher sudah habis.');
        }

        // Create claim
        DB::table('user_vouchers')->insert([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'is_used' => false,
            'claimed_at' => now(),
            'expires_at' => $voucher->duration ? now()->addMinutes($voucher->duration) : $voucher->expiry_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Voucher berhasil diklaim!', 'status' => 'success']);
        }

        return back()->with('success', 'Voucher berhasil diklaim! Cek cart anda.');
    }
}
