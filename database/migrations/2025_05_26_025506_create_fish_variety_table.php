<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishVarietyTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fish_variety', function (Blueprint $table) {
            $table->string('FISH_VARIETY_ID', 36)->primary();
            $table->string('VARIETY_NAME', 100)->nullable();
            $table->text('DESCRIPTION')->nullable();
            $table->string('FISH_ID', 36)->nullable();
            $table->string('IMAGE', 255);
            $table->boolean('IS_DELETED');

            $table->foreign('FISH_ID')->references('FISH_ID')->on('alternative_fish');
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fish_variety');
    }
};