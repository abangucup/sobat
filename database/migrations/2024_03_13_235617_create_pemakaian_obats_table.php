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
        Schema::create('pemakaian_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_obat_id')->constrained()->onDelete('cascade');
            $table->string('banyak');
            $table->text('catatan')->nullable();
            $table->date('tanggal_pemakaian');
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
        Schema::dropIfExists('pemakaian_obats');
    }
};
