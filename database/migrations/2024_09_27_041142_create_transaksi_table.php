<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->unsignedBigInteger('paket_id'); // Relasi ke tabel paket
            $table->string('event_location'); // Lokasi acara
            $table->date('event_start_date'); // Tanggal mulai acara
            $table->date('event_end_date'); // Tanggal akhir acara
            $table->time('event_start_time'); // Waktu mulai acara
            $table->time('event_end_time'); // Waktu akhir acara
            $table->decimal('total', 20, 2); // Total biaya
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending'); // Status transaksi
            $table->timestamps();

            // Foreign key untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
