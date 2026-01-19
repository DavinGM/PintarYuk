<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voucherId = DB::table('vouchers')->where('code', 'PintarYuk_Biarenggak_nanam_sawit')->value('id');

        DB::table('events')->insertOrIgnore([
            [
                'title' => 'Event Bulanan PintarYuk',
                'slug' => Str::slug('Event Bulanan PintarYuk'),
                'description' => 'Ikuti event bulanan kami dan dapatkan voucher menarik khusus untuk Anda yang gemar membaca!',
                'image' => 'https://via.placeholder.com/640x360.png?text=Event+PintarYuk',
                'voucher_id' => $voucherId, // Linked to the voucher
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pesta Buku Akhir Tahun',
                'slug' => Str::slug('Pesta Buku Akhir Tahun'),
                'description' => 'Diskon besar-besaran untuk semua buku pemrograman dan teknologi.',
                'image' => 'https://via.placeholder.com/640x360.png?text=Pesta+Buku',
                'voucher_id' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
