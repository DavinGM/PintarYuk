<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Contoh: PROMOHEMAT
            $table->string('title'); 
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->decimal('reward_amount', 15, 2); // Nilai potongan 
            $table->decimal('min_spend', 15, 2)->default(0); // Syarat minimal belanja
            $table->integer('limit_usage')->default(1); // Berapa kali voucher bisa dipakai
            $table->dateTime('expiry_date'); // Kapan voucher hangus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
