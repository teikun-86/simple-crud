<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'created_at' => now()
            ],
            [
                'name' => 'Teknika Kapal Niaga',
                'created_at' => now()
            ],
            [
                'name' => 'Teknik Kendaraan Ringan',
                'created_at' => now()
            ],
            [
                'name' => 'Teknik Dan Bisnis Sepeda Motor',
                'created_at' => now()
            ],
        ]);
    }
}
