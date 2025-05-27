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
        Schema::create('master_alternatives', function (Blueprint $table) {
            $table->string('MASTER_ALTERNATIVES_ID', 36)->primary();
            $table->string('CRITERIA_ID', 10)->nullable();
            $table->string('FISH_ID', 36)->nullable();
            $table->integer('VALUE')->nullable();

            $table->foreign('CRITERIA_ID')->references('CRITERIA_ID')->on('criteria');
            $table->foreign('FISH_ID')->references('FISH_ID')->on('alternative_fish');
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_alternatives');
    }
};