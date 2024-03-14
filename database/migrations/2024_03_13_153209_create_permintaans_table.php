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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaju');
            $table->unsignedBigInteger('pemverifikasi')->nullable();
            $table->foreignId('stok_obat_id')->constrained()->onDelete('cascade');
            $table->integer('banyak');
            $table->enum('status_permintaan', ['tunda', 'ditolak', 'disetujui', 'selesai'])->default('tunda');
            $table->enum('bidang', ['pelayanan', 'depo']);
            $table->text('catatan')->nullable();

            $table->foreign('pengaju')->references('id')->on('users');
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
        Schema::dropIfExists('permintaans');
    }
};
