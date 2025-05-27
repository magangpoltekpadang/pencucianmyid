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
        Schema::create('transaction_services', function (Blueprint $table){
            $table->id('transaction_service_id');
            $table->string('transaction_id');
            $table->string('service_id');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('discount');
            $table->string('total_discount');
            $table->string('worker_id');
            $table->dateTime('start_timr');
            $table->dateTime('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_services');
    }
};
