<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('active_years')->insert([
            ['id' => 1,'start_date' => '2020-03-01 00:00', 'end_date' => '2021-04-01 00:00', 'year' => 2020, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 2,'start_date' => '2021-04-01 00:00', 'end_date' => '2022-04-01 00:00', 'year' => 2021, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 3,'start_date' => '2022-04-01 00:00', 'end_date' => '2023-04-01 00:00', 'year' => 2022, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
