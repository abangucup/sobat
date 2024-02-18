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
        Schema::create('stok_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distributor_id')->constrained()->onDelete('cascade');
            $table->foreignId('obat_id')->constrained()->onDelete('cascade');
            $table->integer('stok');
            $table->float('harga_beli');
            $table->date('tanggal_beli');
            $table->float('harga_jual');
            $table->enum('lokasi', ['distributor', 'gudang', 'pelayanan', 'depo']);
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
        Schema::dropIfExists('stok_obats');
    }
};
