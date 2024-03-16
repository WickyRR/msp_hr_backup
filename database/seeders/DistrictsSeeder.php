<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([
            ['id'=> 1,'district_name'=>'Colombo','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 2,'district_name'=>'Gampaha','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 3,'district_name'=>'Kalutara','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 4,'district_name'=>'Kandy','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 5,'district_name'=>'Matale','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 6,'district_name'=>'Nuwara Eliya','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 7,'district_name'=>'Galle','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 8,'district_name'=>'Matara','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 9,'district_name'=>'Hambanthota','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 10,'district_name'=>'Jaffna','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 11,'district_name'=>'Kilinpchchi','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 12,'district_name'=>'Mannar','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 13,'district_name'=>'Vavuniya','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 14,'district_name'=>'Mullaitivu','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 15,'district_name'=>'Batticaloa','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 16,'district_name'=>'Ampara','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 17,'district_name'=>'Trincomalee','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 18,'district_name'=>'Kurunegala','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 19,'district_name'=>'Puttalam','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 20,'district_name'=>'Anuradhapura','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 21,'district_name'=>'Polonnaruwa','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 22,'district_name'=>'Badulla','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 23,'district_name'=>'Monaragala','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 24,'district_name'=>'Ratnapura','created_at' => now(), 'updated_at' => now(),],
            ['id'=> 25,'district_name'=>'Kegalle','created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
