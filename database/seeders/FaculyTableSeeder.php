<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaculyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty')->insert([
            ['fac_id' => 1, 'fac_name' => 'Faculty of Engineering', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
            ['fac_id' => 2, 'fac_name' => 'Faculty of Information Technology', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
            ['fac_id' => 3, 'fac_name' => 'Faculty of Business', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
            ['fac_id' => 4, 'fac_name' => 'Faculty of Architecture', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
            ['fac_id' => 5, 'fac_name' => 'Faculty of Medicine', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
            ['fac_id' => 6, 'fac_name' => 'NDT', 'uni_id' => 1, 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
