<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'id' => 1,
                'first_name' =>  'testname testsurname',
                'last_name' =>  'testname testsurname',
                'email' => 'web@moraspirit.com',
                'user_type_id' => 1,
            ],
            [
                'id' => 2,
                'first_name' =>  'testname testsurname',
                'last_name' =>  'testname testsurname',
                'email' => 'hr@moraspirit.com',
                'user_type_id' => 2,
            ],
        ]);
    }
}
