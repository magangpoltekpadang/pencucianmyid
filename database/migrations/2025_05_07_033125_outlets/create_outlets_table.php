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
        Schema::create('id_outlet', function (Blueprint $table) {
            $table->id('id_outlet');
            $table->string('outlet_name',100);
            $table->text('address')->nullable();
            $table->string('phone_number', 20);
            $table->decimal('latitude', 10,8);
            $table->decimal('longitude', 11,8);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
