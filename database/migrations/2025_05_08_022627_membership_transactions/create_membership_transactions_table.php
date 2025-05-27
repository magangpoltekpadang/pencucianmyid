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
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id('memeber_transaction_id');
            $table->integer('customer_id');
            $table->integer('package_id');
            $table->integer('outlet_id');
            $table->integer('transaction_date');
            $table->date('duration_days');
            $table->date('expiry_date');
            $table->float('price');
            $table->integer('payment_method_id');
            $table->integer('staff_id');
            $table->string('receipt_number');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_transactions');
    }
};
