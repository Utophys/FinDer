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
        Schema::create('result', function (Blueprint $table) {
            $table->string('RESULT_ID', 36)->primary();
            $table->dateTime('TIME_ADDED')->nullable();
            $table->string('USER_ID', 36)->nullable();

            $table->foreign('USER_ID')->references('USER_ID')->on('user_account');
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result');
    }
};