<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lokasis')->insert([
            ['nama_lokasi' => 'Bank BJB RSMB', 'created_at' => now(), 'updated_at' => now()],
            ['nama_lokasi' => 'Lazismu UMB', 'created_at' => now(), 'updated_at' => now()],
            ['nama_lokasi' => 'Rajakon Teknik', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}