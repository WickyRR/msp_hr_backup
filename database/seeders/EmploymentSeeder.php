<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EmploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employments')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'start_date' => now()->addMonths(6),
                'end_date' => now()->addMonths(-6),
                'active_year_id' => 1,
                //'member_position_id' => 1,
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'start_date' => now()->addMonths(6),
                'end_date' => now()->addMonths(-6),
                'active_year_id' => 2,
                //'member_position_id' => 1,
                'role_id' => 1,
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'start_date' => now()->addMonths(6),
                'end_date' => now()->addMonths(-6),
                'active_year_id' => 3,
                //'member_position_id' => 1,
                'role_id' => 8,
            ],
        ]);
    }
}
