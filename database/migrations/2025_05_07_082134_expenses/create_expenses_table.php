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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id('expense_id');
            $table->string('expense_code',50);
            $table->unsignedBigInteger('outlet_id');
            $table->date('expense_date');
            $table->float('amount',10.2);
            $table->string('category');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('shift_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('outlet_id')->Reference('id_outlet')->on('Outlet')->onDelete('cascade');
            $table->foreign('Shift')->Reference('shift_id')->on('Shift')->onDelete('cascade');
            $table->foreign('Staff')->Reference('staff_id')->on('Staff')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exepenses');
    }
};
