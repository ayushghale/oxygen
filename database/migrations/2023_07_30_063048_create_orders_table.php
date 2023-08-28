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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('order_quantity');
            $table->decimal('order_amount', 20, 3);
            $table->string('remarks');
            $table->integer('status')->default(3); //(0 = cancel,1 = pending, 2 = completed)
            $table->string('t_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
