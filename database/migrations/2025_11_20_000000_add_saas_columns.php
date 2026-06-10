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
        // Update companies table
        Schema::table('companies', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('address')->nullable()->after('name');
            $table->string('phone')->nullable()->after('address');
            $table->string('email')->nullable()->after('phone');
            $table->string('logo')->nullable()->after('email');
            $table->unsignedBigInteger('owner_id')->nullable()->after('logo');
        });

        // Add company_id to users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->onDelete('cascade');
        });

        // List of tables to add company_id to
        $tables = [
            'products',
            'customers',
            'transactions',
            'services',
            'categories',
            'items',
            'collections',
            // 'mesin_cucis' - need to verify table name
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->onDelete('cascade');
                });
            }
        }
        
        // Special check for mesin_cucis or similar
        if (Schema::hasTable('mesin_cucis')) {
             Schema::table('mesin_cucis', function (Blueprint $table) {
                $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->onDelete('cascade');
            });
        } elseif (Schema::hasTable('mesin_laundry')) { // Fallback check
             Schema::table('mesin_laundry', function (Blueprint $table) {
                $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'users',
            'products',
            'customers',
            'transactions',
            'services',
            'categories',
            'items',
            'collections',
            'mesin_cucis',
            'mesin_laundry'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropForeign(['company_id']);
                    $table->dropColumn('company_id');
                });
            }
        }

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['name', 'address', 'phone', 'email', 'logo', 'owner_id']);
        });
    }
};
