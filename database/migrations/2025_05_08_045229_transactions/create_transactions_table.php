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
            $table->id('transaction_id');
            $table->string('transaction_code');
            $table->integer('customer_id');
            $table->integer('outlet_id');
            $table->date('transaction_date');
            $table->date('duration_days');
            $table->float('subtotal');
            $table->float('discount');
            $table->float('tax');
            $table->float('final_price');
            $table->integer('payment_status_id');
            $table->boolean('gate_opened')->default(true);
            $table->integer('staff_id');
            $table->integer('shift_id');
            $table->boolean('receipt_printed')->default(true);
            $table->boolean('whatsapp_sent')->default(true);
            $table->text('notes')->nullable();
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
