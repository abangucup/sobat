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
        Schema::create('tebus_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained()->onDelete('cascade');
            $table->enum('status_bayar', ['lunas', 'pending'])->default('pending');
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
        Schema::dropIfExists('tebus_obats');
    }
};
