<?php

namespace Database\Seeders;

use App\Models\AkunDistributor;
use App\Models\Distributor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distributor = Distributor::create([
            'nama_perusahaan' => 'PT. KIMIA FARMA',
            'slug' => Str::slug('PT. KIMIA FARMA'),
            'telepon_perusahaan' => '-',
            'pemilik_perusahaan' => '-',
            'lokasi_perusahaan' => '-'
        ]);

        AkunDistributor::create([
            'distributor_id' => $distributor->id,
            'user_id' => 2,
        ]);
    }
}
