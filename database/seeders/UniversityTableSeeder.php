<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('university')->insert([
            ['university_id' => 1,'university_name' => 'University of Moratuwa', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
