<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'biodata_id' => 1,
                'username' => 'gudang',
                'password' => Hash::make('password'),
                'role' => 'gudang',
                'email' => 'windygudang@gmail.com',
            ],
            [
                'biodata_id' => 2,
                'username' => 'distributor',
                'password' => Hash::make('password'),
                'role' => 'distributor',
                'email' => 'windydistributor@gmail.com',
            ],
            [
                'biodata_id' => 3,
                'username' => 'pelayanan',
                'password' => Hash::make('password'),
                'role' => 'pelayanan',
                'email' => 'windypelayanan@gmail.com',
            ],
            [
                'biodata_id' => 4,
                'username' => 'depo',
                'password' => Hash::make('password'),
                'role' => 'depo',
                'email' => 'windydepo@gmail.com',
            ],
            [
                'biodata_id' => 5,
                'username' => 'ppk',
                'password' => Hash::make('password'),
                'role' => 'ppk',
                'email' => 'windyppk@gmail.com',
            ],
            [
                'biodata_id' => 1,
                'username' => 'direktur',
                'password' => Hash::make('password'),
                'role' => 'direktur',
                'email' => 'windydirektur@gmail.com',
            ],
            [
                'biodata_id' => 1,
                'username' => 'poli',
                'password' => Hash::make('password'),
                'role' => 'poli',
                'email' => 'windypoli@gmail.com',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
