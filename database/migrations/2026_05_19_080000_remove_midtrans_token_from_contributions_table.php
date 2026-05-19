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
        Schema::table('contributions', function (Blueprint $table) {
            if (Schema::hasColumn('contributions', 'midtrans_token')) {
                $table->dropColumn('midtrans_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contributions', function (Blueprint $table) {
            if (! Schema::hasColumn('contributions', 'midtrans_token')) {
                $table->string('midtrans_token')->nullable()->after('status');
            }
        });
    }
};
