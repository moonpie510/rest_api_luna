<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $token = config('app.api_key');
        $this->route = "/api/v1/$token/organizations";
    }

    public function test_get_organizations_by_building_success(): void
    {
        $building = Building::factory()->create();
        $organization = Organization::factory(2)->create(['building_id' => $building->id]);

        $response = $this->get("$this->route/building/$building->id");

        $response->assertJson([ "success" => true]);
        $response->assertJsonCount(2, 'data.organizations');
    }

    public function test_get_organizations_by_activity_success(): void
    {
        $building = Building::factory()->create();
        $activity = Activity::factory()->create();
        $organization = Organization::factory()->create(['building_id' => $building->id]);
        $organization->activities()->attach($activity->id);

        $response = $this->get("$this->route/activity/$activity->id");

        $response->assertJson([ "success" => true]);
        $response->assertJsonCount(1, 'data.organizations');
    }

    public function test_get_organizations_by_activity_recursive_success(): void
    {
        $building = Building::factory()->create();
        $organizationFirst = Organization::factory()->create(['building_id' => $building->id]);
        $organizationSecond = Organization::factory()->create(['building_id' => $building->id]);

        $activityParent = Activity::factory()->create();
        $activityChild = Activity::factory()->create(['parent_id' => $activityParent->id]);
        $activityOther = Activity::factory()->create(['parent_id' => null]);

        $organizationFirst->activities()->attach($activityParent->id);
        $organizationSecond->activities()->attach($activityChild->id);
        $organizationSecond->activities()->attach($activityOther->id);

        $response = $this->get("$this->route/activity/$activityParent->id/recursive");

        $response->assertJson([ "success" => true]);
        $response->assertJsonCount(2, 'data.organizations');
    }

    public function test_get_organizations_by_coordinates_success(): void
    {
        $building = Building::factory()->create();
        $organizations = Organization::factory(3)->create(['building_id' => $building->id]);
        $params = [
            'lat_min' => $building->latitude,
            'lat_max' => $building->latitude,
            'lng_min' => $building->longitude,
            'lng_max' => $building->longitude,
        ];

        $query = http_build_query($params);

        $response = $this->get("$this->route/coordinates?$query");

        $response->assertJson([ "success" => true]);
        $response->assertJsonCount(3, 'data.organizations');
    }

    public function test_get_organizations_by_id_success(): void
    {
        $building = Building::factory()->create();
        $organization = Organization::factory()->create(['building_id' => $building->id]);

        $response = $this->get("$this->route/$organization->id");

        $response->assertJson([ "success" => true]);
    }
}
