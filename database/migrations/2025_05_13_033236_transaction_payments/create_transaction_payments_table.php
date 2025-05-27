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
         Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->decimal('amount', 12,2);
            $table->dateTime('payment_date');
            $table->string('reference_number');
            $table->unsignedBigInteger('status_id');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('transaction_id')->Reference('transaction_id')->on('transactions')->onDelete('cascade');
            $table->foreign('payment_method_id')->Reference('payment_method_id')->on('payment_methodes')->onDelete('cascade');
            $table->foreign('status_id')->Reference('status_id')->on('payment_statuses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};
