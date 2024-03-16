<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('member_positions')->insert([
            ['id' => 1,'position_name' => 'Chief Operating Officer', 'position_slug' => 'coo', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 2,'position_name' => 'Chief Executive Officer', 'position_slug' => 'cxo', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 3,'position_name' => 'Chief Strategic Officer', 'position_slug' => 'cso', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 4,'position_name' => 'Finance Controller', 'position_slug' => 'fc', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 5,'position_name' => 'Pillar Head', 'position_slug' => 'pillar_head', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 6,'position_name' => 'Assistant Pillar Head', 'position_slug' => 'assistant_pillar_head', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 7,'position_name' => 'Member', 'position_slug' => 'member', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
