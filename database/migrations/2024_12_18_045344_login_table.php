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
        Schema::create('LOGIN', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->string('nama_lengkap'); // Nama lengkap pengguna
            $table->string('email')->unique(); // Email unik
            $table->string('username')->unique(); // Username unik
            $table->string('password'); // Password
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LOGIN'); // Hapus tabel users
    }
};
