<?php

namespace Tests\Feature;

use App\Action;
use App\Hierarchy;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected $user;
    protected $user_id;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Hierarchy::class, 1)->create(['user_id' => $this->user->id]);
    }

    public function generateActionDescriptions($num_of_descriptions)
    {
        $actions = [];
        for($i = 1; $i <= $num_of_descriptions; $i++){
            $actions["description_" . "$i"] = $this->faker->sentence(6);
        }
        return $actions;
    }

    public function test_storeTen_stores_ten_rows_in_actions_table()
    {
        $hierarchy_id = 1;
        $count = 1;
        $action_descriptions = $this->generateActionDescriptions(10);
        $response = $this->actingAs($this->user)
                            ->json('POST', "/api/hierarchy/$hierarchy_id/actions", $action_descriptions);
        $this->assertEquals(200, $response->getStatusCode());
        foreach($action_descriptions as $description) {
            $this->assertDatabaseHas('actions',[
                'hierarchy_id' => $hierarchy_id,
                'level' => $count,
                'description' => $description
            ]);
            $count++;
        }
    }
}
