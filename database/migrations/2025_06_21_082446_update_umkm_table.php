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
        Schema::table('umkm', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');

            // 2. Menambahkan kolom status untuk alur persetujuan admin
            $table->string('status')->default('pending')->after('rating'); // pending, approved, rejected

            // 3. Menghapus kolom 'pemilik' yang lama
            $table->dropColumn('pemilik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('status');

            // Tambahkan kembali kolom pemilik jika di-rollback
            $table->string('pemilik', 45)->after('modal');
        });
    }
};
