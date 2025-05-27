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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('notification_type_id');
            $table->text('message');
            $table->dateTime('sent_at');
            $table->unsignedBigInteger('status_id');
            $table->string('status_id');
            $table->integer('rentry_count');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('customer_id')->Reference('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('notification_type_id')->Reference('notification_type_id')->on('notification_types')->onDelete('cascade');
            $table->foreign('status_id')->Reference('status_id')->on('notification_statuses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
