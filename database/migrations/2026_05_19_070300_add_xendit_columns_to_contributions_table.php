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
            $table->string('xendit_invoice_id')->nullable()->after('status');
            $table->text('checkout_url')->nullable()->after('xendit_invoice_id');
            $table->json('xendit_response')->nullable()->after('checkout_url');
            $table->string('payment_method')->default('UNPAID')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contributions', function (Blueprint $table) {
            //
        });
    }
};
