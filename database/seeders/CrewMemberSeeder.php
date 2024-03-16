<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CrewMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('crew__members')->insert([
            [
                'id' => 1,
                'batch' =>  1,
                'address' =>  '23, test road, test country',
                'birthday' =>  now()->addYears(-21),
                'pillar' => 'web',
                'facebook_url' => 'https://www.facebook.com/',
                'instagram_url' => 'https://www.instagram.com/',
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'user_full_name' =>  'testname testsurname',
                'batch' =>  1,
                'address' =>  '23, test road, test country',
                'birthday' =>  now()->addYears(-21),
                'pillar' => 'editorial',
                'facebook_url' => 'https://www.facebook.com/',
                'instagram_url' => 'https://www.instagram.com/',
                'user_id' => 2,
            ],
        ]);
    }
}
