<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('auths')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'password' => Hash::make('MSP@web21'),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'password' => Hash::make('MSP@hr21'),
            ],
        ]);
    }
}
