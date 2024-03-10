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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->string('slug');
            $table->enum('satuan', [
                'Kotak (box)',
                'Botol Besar (bottle)',
                'Kemasan (pack)',
                'Karton (carton)',
                'Jerigen (jerry can)',
                'Drum',
                'Bal (bale)'

            ]);
            $table->string('no_batch');
            $table->date('tanggal_kedaluwarsa');
            $table->string('kapasitas')->nullable();
            $table->enum('satuan_kapasitas', [
                'Tablet (tab)',
                'Kapsul (kap / cps)',
                'Kaplet',
                'Sirup',
                'Krim',
                'Salep',
                'Serbuk',
                'Injeksi',
                'Tetes',
                'Supositoria',
                'Aerosol',
                'Suspensi',
                'Larutan',
                'Ampul',
                'Botol',
                'Tube',
                'Strip',
                'Sachet',
            ])->nullable();
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
        Schema::dropIfExists('obats');
    }
};
