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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('payment_type');
            $table->decimal('total_amount', 20, 3);
            $table->date('payment_date');
            $table->string('payment_time');
            $table->string('t_code');
            $table->integer('payment_status')->default(2); // 0: cancel , 1: done, 2: in process
            $table->string('online_Transaction_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
