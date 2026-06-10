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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('metode', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Note: Reverting to enum is tricky in some databases without raw SQL, 
            // but we'll try standard Laravel way or just leave it as string for safety in dev.
            // Ideally: $table->enum('metode', ['cash', 'transfer'])->change(); 
            // Since we added data that might violate the enum, let's keep it simple for now or use text.
            $table->enum('metode', ['cash', 'transfer'])->change();
        });
    }
};
