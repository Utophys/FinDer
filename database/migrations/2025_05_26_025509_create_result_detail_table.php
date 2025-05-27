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
        Schema::create('result_detail', function (Blueprint $table) {
            $table->string('RESULT_DETAIL_ID', 36)->primary();
            $table->integer('RANKING')->nullable();
            $table->string('RESULT_ID', 36)->nullable();
            $table->string('FISH_ID', 36)->nullable();
            $table->double('SCORE'); // Sesuai dump data memiliki banyak desimal

            $table->foreign('RESULT_ID')->references('RESULT_ID')->on('result');
            $table->foreign('FISH_ID')->references('FISH_ID')->on('alternative_fish');
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_detail');
    }
};