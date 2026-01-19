<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Kategori Asli
            [
                'name' => 'Sains & Developer',
                'slug' => 'sains-developer',
                'icon' => '🔬',
                'color' => 'from-blue-500/20',
            ],
            [
                'name' => 'Kedokteran',
                'slug' => 'kedokteran',
                'icon' => '🏥',
                'color' => 'from-emerald-500/20',
            ],
            [
                'name' => 'Ekonomi & Bisnis',
                'slug' => 'ekonomi-bisnis',
                'icon' => '📈',
                'color' => 'from-amber-500/20',
            ],
            [
                'name' => 'Sastra & Seni',
                'slug' => 'sastra-seni',
                'icon' => '🎨',
                'color' => 'from-rose-500/20',
            ],
            
            // Penambahan Kategori Baru
            [
                'name' => 'Teknologi AI',
                'slug' => 'teknologi-ai',
                'icon' => '🤖',
                'color' => 'from-purple-500/20',
            ],
            [
                'name' => 'Psikologi',
                'slug' => 'psikologi',
                'icon' => '🧠',
                'color' => 'from-indigo-500/20',
            ],
            [
                'name' => 'Pendidikan',
                'slug' => 'pendidikan',
                'icon' => '🎓',
                'color' => 'from-cyan-500/20',
            ],
            [
                'name' => 'Hukum & Politik',
                'slug' => 'hukum-politik',
                'icon' => '⚖️',
                'color' => 'from-slate-500/20',
            ],
            [
                'name' => 'Olahraga & Kesehatan',
                'slug' => 'olahraga-kesehatan',
                'icon' => '🏃',
                'color' => 'from-orange-500/20',
            ],
            [
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'icon' => '🍳',
                'color' => 'from-yellow-500/20',
            ],
            [
                'name' => 'Travel & Alam',
                'slug' => 'travel-alam',
                'icon' => '🏔️',
                'color' => 'from-green-500/20',
            ],
            [
                'name' => 'Fotografi',
                'slug' => 'fotografi',
                'icon' => '📸',
                'color' => 'from-zinc-500/20',
            ],
            [
                'name' => 'Musik',
                'slug' => 'musik',
                'icon' => '🎸',
                'color' => 'from-pink-500/20',
            ],
            [
                'name' => 'Sejarah',
                'slug' => 'sejarah',
                'icon' => '📜',
                'color' => 'from-stone-500/20',
            ],
            [
                'name' => 'Keuangan Personal',
                'slug' => 'keuangan-personal',
                'icon' => '💰',
                'color' => 'from-lime-500/20',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'icon' => '✨',
                'color' => 'from-violet-500/20',
            ],
        ];

        // Menambahkan timestamp secara otomatis agar kode lebih bersih
        $data = array_map(function ($category) {
            $category['created_at'] = now();
            $category['updated_at'] = now();
            return $category;
        }, $categories);

        DB::table('categories')->insert($data);
    }
}