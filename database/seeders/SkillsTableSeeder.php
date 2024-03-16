<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            ['skill_name' => 'Public Speaking', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Content Management', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Team Management', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Event Management', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Pitching', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Negotiation', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Article Writing', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Videography', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Video Editing', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Photography', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Graphic Designing', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Frontend Web Designing', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Web Development', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Mobile App Development', 'created_at' => now(), 'updated_at' => now(),],
            ['skill_name' => 'Other', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
