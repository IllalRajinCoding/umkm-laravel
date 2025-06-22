<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Menggunakan Schema::table() untuk memodifikasi tabel 'umkm' yang sudah ada
        Schema::table('umkm', function (Blueprint $table) {
            // Perintah ini akan menambahkan kolom 'created_at' dan 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Ini adalah kebalikan dari fungsi up, untuk jika Anda perlu rollback
        Schema::table('umkm', function (Blueprint $table) {
            // Perintah ini akan menghapus kolom 'created_at' dan 'updated_at'
            $table->dropTimestamps();
        });
    }
};
