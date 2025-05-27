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
        Schema::create('master_criteria', function (Blueprint $table) {
            $table->string('MASTER_CRITERIA_ID', 36)->primary();
            $table->string('USER_ID', 36)->nullable();
            $table->string('CRITERIA_ID', 10)->nullable();
            $table->string('WEIGHT_TXT', 40)->nullable();
            $table->integer('WEIGHT_INT')->nullable();
            $table->string('RESULT_ID', 36)->nullable();

            $table->foreign('USER_ID')->references('USER_ID')->on('user_account');
            $table->foreign('CRITERIA_ID')->references('CRITERIA_ID')->on('criteria');
            $table->foreign('RESULT_ID', 'fk_master_criteria_result_id')->references('RESULT_ID')->on('result'); // penamaan foreign key eksplisit
            // Tidak ada timestamps (created_at, updated_at) di dump
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_criteria');
    }
};