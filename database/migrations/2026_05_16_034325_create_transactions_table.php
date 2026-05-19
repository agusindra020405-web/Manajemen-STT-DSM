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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke tabel members (anggota)
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');

            $table->string('month'); // Bulan iuran
            $table->string('year');  // Tahun iuran
            $table->integer('amount'); // Nominal (misal: 50000)

            // Kolom status sesuai rancangan Anda (misal: 'PAID', 'UNPAID')
            $table->string('status')->default('UNPAID');

            // Metode pembayaran (CASH, MIDTRANS, dll)
            $table->string('payment_method')->default('CASH');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
