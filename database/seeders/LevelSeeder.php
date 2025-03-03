<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => 1, 'level_kode' => 'ADM', 'lavel_name' => 'Administrator'],
            ['level_id' => 2, 'level_kode' => 'MNG', 'lavel_name' => 'Manager'],
            ['level_id' => 3, 'level_kode' => 'STF', 'lavel_name' => 'Staff/Kasir'],
        ];
        DB::table('m_level')->insert($data);
    }
}
