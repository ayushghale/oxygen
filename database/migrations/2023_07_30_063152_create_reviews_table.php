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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');//(user_id)
            $table->integer('service_id');//(service_id
            $table->integer('rating');//(1-5)
            $table->longText('review');
            $table->date('review_date');
            $table->string('t_code');//(t_code)
            $table->integer('status')->default('1');//( 1 = show, 0 = hide )(hide,show) 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
