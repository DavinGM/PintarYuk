<?php

namespace Database\Seeders;

use App\Models\Voucher; // Assuming Voucher model exists or I need to create/check namespace
// Note: I will check Model namespace in next step if this fails, but it usually is App\Models
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default voucher from user request
        DB::table('vouchers')->insertOrIgnore([
            [
                'code' => 'PintarYuk_Biarenggak_nanam_sawit',
                'title' => 'Diskon Pintar Yuk',
                'type' => 'fixed',
                'reward_amount' => 10000,
                'min_spend' => 50000,
                'limit_usage' => 100, // Global limit
                'expiry_date' => Carbon::now()->addMonths(1),
                'duration' => 120, // 2 hours in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MINUM100',
                'title' => 'Diskon Minum Belanja 100rb',
                'type' => 'fixed',
                'reward_amount' => 15000,
                'min_spend' => 100000,
                'limit_usage' => 50,
                'expiry_date' => Carbon::now()->addMonths(1),
                'duration' => 60, // 1 hour
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
