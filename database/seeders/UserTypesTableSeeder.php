<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            ['id' => 1,'user_type_name' => 'Crew Member', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 2,'user_type_name' => 'Exco Member', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
