<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ActiveYearsTableSeeder::class,
            MemberPositionsTableSeeder::class,
            UserTypesTableSeeder::class,
            PillarsTableSeeder::class,
            UniversityTableSeeder::class,
            FaculyTableSeeder::class,
            UserTableSeeder::class,
            SkillsTableSeeder::class,
            RecruitProcessesTableSeeder::class,
            AuthSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            PermissionRoleSeeder::class,
            EmploymentSeeder::class,
            EmploymentsPermissionsSeeder::class,
            DistrictsSeeder::class,
            PillarMembersSeeder::class,
            KPIScoresSeeder::class
        ]);
    }
}
