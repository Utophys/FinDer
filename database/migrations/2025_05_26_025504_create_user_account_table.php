<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_account', function (Blueprint $table) {
            $table->string('USER_ID', 36)->primary();
            $table->string('USERNAME', 50)->nullable();
            $table->string('DISPLAY_NAME', 100)->nullable();
            $table->string('PASSWORD', 100)->nullable();
            $table->boolean('SET_PASSWORD')->default(false); // Added based on ALTER TABLE
            $table->string('ROLE', 20)->nullable();
            $table->string('EMAIL', 255)->unique();
            $table->string('PHONE_NUMBER', 255)->nullable();
            $table->string('IMAGE', 255); // NOT NULL (can be empty string)
            $table->boolean('IS_DELETED');
            $table->rememberToken(); // remember_token varchar(100) DEFAULT NULL
            // Tidak ada timestamps (created_at, updated_at) di dump,
            // namun rememberToken() mungkin memerlukan mereka. Jika tidak, hapus rememberToken()
            // atau tambahkan $table->timestamps() jika diperlukan oleh fitur Laravel lain.
        });

        // Trigger: Jika IS_DELETED harus selalu 0 saat insert dan tidak dihandle aplikasi
        // ini bisa jadi alternatif. Pertimbangkan apakah ini lebih baik dihandle di Model Eloquent.
        // DB::unprepared('
        //     CREATE TRIGGER `trg_insert_user_account` BEFORE INSERT ON `user_account`
        //     FOR EACH ROW BEGIN
        //         SET NEW.is_deleted = 0;
        //     END
        // ');
        // Pada umumnya, default value di model atau saat create lebih disarankan.
        // Kolom IS_DELETED sudah NOT NULL, jadi nilai harus disediakan aplikasi atau punya default di DB.
        // Jika Anda ingin default DB, tambahkan ->default(0) pada kolom IS_DELETED di atas.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::unprepared('DROP TRIGGER IF EXISTS `trg_insert_user_account`');
        Schema::dropIfExists('user_account');
    }
};