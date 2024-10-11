<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // Tambahkan username
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_type')->default('admin'); 
            $table->string('phone')->nullable(); // Kolom untuk nomor telepon
            $table->string('address')->nullable(); // Kolom untuk alamat
            $table->string('image')->nullable(); // Kolom untuk gambar profil
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
}
