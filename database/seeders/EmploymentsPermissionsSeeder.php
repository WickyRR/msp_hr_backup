<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class EmploymentsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('employments_permissions')->insert([
            ['permission_id' => 1, 'employment_id' => 1],
            ['permission_id' => 1, 'employment_id' => 2],
        ]);

    }
}
