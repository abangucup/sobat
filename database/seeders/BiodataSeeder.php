<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $biodatas = [
            [
                // id 1 level gudang
                'nama_lengkap' => 'Windy Gudang',
                'slug' => Str::slug('Windy Gudang'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'l'
            ],
            [
                // id 2 level distributor
                'nama_lengkap' => 'Windy Distributor',
                'slug' => Str::slug('Windy Distributor'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'l'
            ],
            [
                // id 3 level pelayanan
                'nama_lengkap' => 'Windy Pelayanan',
                'slug' => Str::slug('Windy Pelayanan'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'p'
            ],
            [
                // id 4 level depo
                'nama_lengkap' => 'Windy Depo',
                'slug' => Str::slug('Windy Depo'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'p'
            ],
            [
                // id 5 level ppk
                'nama_lengkap' => 'PPK Windy',
                'slug' => Str::slug('PPK Windy'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'l'
            ],
            [
                // id 6 level direktur
                'nama_lengkap' => 'Direktur Windy',
                'slug' => Str::slug('Direktur Windy'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'l'
            ],
            [
                // id 7 level poli
                'nama_lengkap' => 'Windy Poli',
                'slug' => Str::slug('Windy Poli'),
                'no_hp' => '6285397916024',
                'alamat' => 'Batudaa',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'l'
            ],

        ];

        foreach ($biodatas as $biodata) {
            Biodata::create($biodata);
        }
    }
}
