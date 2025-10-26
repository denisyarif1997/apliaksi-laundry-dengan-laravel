<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('kode_transaksi')->unique();
            $table->date('tanggal_masuk');
            $table->date('tanggal_selesai')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status', ['pending', 'proses', 'selesai', 'diambil'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transactions');
    }
};
