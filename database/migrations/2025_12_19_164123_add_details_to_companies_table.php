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
        Schema::table('companies', function (Blueprint $table) {
            // Check if columns exist before adding/modifying to be safe, or just add the missing ones
            // 'name', 'address', 'phone', 'email', 'logo' already exist from add_saas_columns migration
            
            if (!Schema::hasColumn('companies', 'telephone')) {
                $table->string('telephone')->after('phone')->nullable(); // For WhatsApp, distinct from 'phone'
            }
            if (!Schema::hasColumn('companies', 'footer_message')) {
                $table->text('footer_message')->after('logo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'footer_message']);
        });
    }
};
