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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id');
            $table->string('hasil_uji_lab')->nullable();
            $table->text('deskripsi_tindakan')->nullable();
            $table->string('hasil_pemeriksaan')->nullable();
            $table->string('dokter_pemeriksa');
            $table->string('spesialisasi');
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
        Schema::dropIfExists('pemeriksaans');
    }
};
