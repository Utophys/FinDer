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
        Schema::create('alternative_fish', function (Blueprint $table) {
            $table->string('FISH_ID', 36)->primary();
            $table->string('NAME', 100)->nullable();
            $table->text('DESCRIPTION')->nullable();
            $table->string('FOOD_ID', 36)->nullable();
            $table->string('IMAGE', 255)->nullable();
            $table->boolean('IS_VERIFIED');
            $table->boolean('IS_DELETED');

            $table->foreign('FOOD_ID')->references('FOOD_ID')->on('food');
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternative_fish');
    }
};