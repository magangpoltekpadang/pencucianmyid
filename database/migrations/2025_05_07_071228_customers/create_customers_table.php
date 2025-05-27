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
       
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('plat_numebr', 15);
            $table->string('name', 100);
            $table->string('phone', 20);
            $table->unsignedBigInteger('vehicle_type_id');
            $table->string('vehicle_color', 20);
            $table->string('member_number', 30);
            $table->date('join_date');
            $table->date('member_expiry_date');
            $table->boolean('is_member')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('vehicle_type_id')->Reference('vehicle_type_id')->on('VehicleType')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     
        Schema::dropIfExists('customers');
    }
    
};
