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
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom id menjadi user_id
            $table->renameColumn('id', 'user_id');

            // Hapus kolom email_verified_at dan remember_token
            $table->dropColumn(['email_verified_at', 'remember_token']);

            // Tambahkan kolom baru
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->enum('role', ['kasir', 'pemilik usaha'])->default('kasir');
            $table->string('username')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan perubahan
            $table->renameColumn('user_id', 'id');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->dropColumn(['alamat', 'kontak', 'role', 'username']);
        });
    }
};
