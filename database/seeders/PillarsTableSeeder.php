<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PillarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pillar')->insert([
            ['pillar_id' => 1, 'pillar_name' => 'Human Resources Management Pillar', 'pillar_short_name' => 'HR', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 2, 'pillar_name' => 'Creative Design Pillar', 'pillar_short_name' => 'Creative', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 3, 'pillar_name' => 'News Operation Pillar', 'pillar_short_name' => 'News', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 4, 'pillar_name' => 'Marketing Pillar', 'pillar_short_name' => 'Marketing', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 5, 'pillar_name' => 'Special Projects Pillar', 'pillar_short_name' => 'Special', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 6, 'pillar_name' => 'Cooperative Development Pillar', 'pillar_short_name' => 'Cooperative', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 7, 'pillar_name' => 'Editorial Pillar', 'pillar_short_name' => 'Editorial', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 8, 'pillar_name' => 'Web and Technology Pillar', 'pillar_short_name' => 'Web', 'created_at' => now(), 'updated_at' => now(),],
            ['pillar_id' => 9, 'pillar_name' => 'Video Editing & Streaming Pillar', 'pillar_short_name' => 'Video', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
