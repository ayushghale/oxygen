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
        Schema::create('notifies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('notify_date');
            $table->string('notify_type'); //(order, payment, review)
            $table->longText('notify_message');
            $table->integer('notify_status')->default('1'); //(0/1) (0: hide, 1: display) (default: 0)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifies');
    }
};
