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
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->enum('status_kirim_naskah', ['terkirim', 'pending'])->default('pending');
            $table->enum('status_verif_ppk', ['diverifikasi', 'pending', 'ditolak'])->default('pending');
            $table->enum('status_verif_direktur', ['diverifikasi', 'pending', 'ditolak'])->default('pending');
            $table->enum('status_pemesanan', ['selesai', 'proses', 'pending'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
};
