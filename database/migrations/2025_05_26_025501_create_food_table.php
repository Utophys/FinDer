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
        Schema::create('food', function (Blueprint $table) {
            $table->string('FOOD_ID', 36)->primary();
            $table->string('NAME', 100)->nullable();
            $table->string('DESCRIPTION', 200)->nullable();
            $table->string('IMAGE', 255); // NOT NULL as per dump
            $table->boolean('IS_DELETED'); // tinyint(1) NOT NULL
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};