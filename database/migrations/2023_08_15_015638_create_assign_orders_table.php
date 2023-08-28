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
        Schema::create('assign_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->string('t_code');
            $table->string('remark')->nullable();
            $table->integer('status')->default(2); // 0: cancel , 1: done, 2: in process
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_orders');
    }
};
