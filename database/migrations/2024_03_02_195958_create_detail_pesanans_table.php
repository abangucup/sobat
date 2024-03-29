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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->constrained()->onDelete('restrict');
            $table->foreignId('pemesanan_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('jumlah');
            $table->float('harga_pesanan', 10, 2);
            $table->enum('status_pengiriman', ['sampai','dikirim', 'dibatalkan', 'ditunda'])->default('ditunda');
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
        Schema::dropIfExists('detail_pesanans');
    }
};
