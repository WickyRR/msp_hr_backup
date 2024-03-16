<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1,'role_name' => 'Chief Operating Officer', 'role_slug' => 'r_coo', 'pillar_id' => null, 'member_position_id' => 1],
            ['id' => 2,'role_name' => 'Chief Executive Officer', 'role_slug' => 'r_cxo', 'pillar_id' => null, 'member_position_id' => 2],
            ['id' => 3,'role_name' => 'Chief Strategic Officer', 'role_slug' => 'r_cso', 'pillar_id' => null, 'member_position_id' => 3],
            ['id' => 4,'role_name' => 'Finance Controller', 'role_slug' => 'r_fc', 'pillar_id' => null, 'member_position_id' => 4],

            ['id' => 5,'role_name' => 'Head of Human Resources Management Pillar', 'role_slug' => 'r_head_hr', 'pillar_id' => 1, 'member_position_id' => 5],
            ['id' => 6,'role_name' => 'Assistant Head of Human Resources Management Pillar', 'role_slug' => 'r_ast_head_hr', 'pillar_id' => 1, 'member_position_id' => 6],
            ['id' => 7,'role_name' => 'Member of Human Resources Management Pillar', 'role_slug' => 'r_memb_hr', 'pillar_id' => 1, 'member_position_id' => 7],

            ['id' => 8,'role_name' => 'Head of Web and Technology Pillar', 'role_slug' => 'r_head_web', 'pillar_id' => 8, 'member_position_id' => 5],
            ['id' => 9,'role_name' => 'Assistant Head of Web and Technology Pillar', 'role_slug' => 'r_ast_head_web', 'pillar_id' => 8, 'member_position_id' => 6],
            ['id' => 10,'role_name' => 'Member of Web and Technology Pillar', 'role_slug' => 'r_memb_web', 'pillar_id' => 8, 'member_position_id' => 7],

        ]);

    }
}
