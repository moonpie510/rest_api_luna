<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use App\Models\OrganizationActivity;
use App\Models\OrganizationPhone;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Building::factory(10)->create();
        Activity::factory(15)->create();

        Organization::factory(10)->create();
        OrganizationPhone::factory(30)->create();
        OrganizationActivity::factory(30)->create();
    }
}
