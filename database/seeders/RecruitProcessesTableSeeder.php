<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecruitProcessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recruit_processes')->insert([
            [
                'process_name' => 'Moraspirit Recruitment 2021',
                'instructions' => '<ul><li>Mandatory fields are marked in red.</li>
                                        <li>If you encounter any problem during the process, please contact one of the people mentioned at the bottom of this page.</li>
                                        <li>Application Deadline - 23:59, 25th March 2021</li></ul>',
                'contact_details' => 'Ashiri - 076 432 3233 <br>Thilina - 076 522 5553 <br>Pavara - 076 924 5538',
                'year_id' => 2,
                'start_date' => date("2021-03-20 17:00:00"),
                'close_date' => date("2021-03-25 23:59:59"),
                'process_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
