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
        Schema::create('expireds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_obat_id')->constrained();
            $table->enum('status_pengembalian', ['pending', 'disetujui', 'selesai'])->default('pending');
            $table->text('catatan')->nullable();
            $table->text('balasan')->nullable();
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
        Schema::dropIfExists('expireds');
    }
};
