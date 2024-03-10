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
        Schema::create('verif_pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemverifikasi');
            $table->foreignId('detail_pesanan_id')->constrained()->onDelete('cascade');
            $table->enum('kondisi_pesanan', ['sesuai', 'tidak_sesuai'])->default('tidak_sesuai');
            $table->text('catatan')->nullable();

            $table->foreign('pemverifikasi')->references('id')->on('users');
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
        Schema::dropIfExists('verif_pesanans');
    }
};
