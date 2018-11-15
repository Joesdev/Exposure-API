<?php

namespace Tests\Unit;

use App\Action;
use App\Hierarchy;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActionControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;
    protected $num_hierarchies = 1;
    protected $hierarchy;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->hierarchy = factory(Hierarchy::class, $this->num_hierarchies)->create(['user_id' => $this->user->id]);
    }

    public function test_store_stores_a_single_row_in_actions_table(){
        $hierarchy_id = 1;
        $level = random_int(1,10);
        $description = $this->generateActionDescriptions(1);
        $response = $this->actingAs($this->user)
            ->json('POST', "/api/hierarchy/$hierarchy_id/action", [
                'level' => $level,
                'description' => implode($description)
            ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('actions', [
            'hierarchy_id' => $hierarchy_id,
            'level' => $level,
            'description' => $description
        ]);
    }

    public function test_index_retrieves_all_actions_for_a_hierarchy()
    {
        $hierarchy_id = $this->hierarchy->first()->id;
        $actions = factory(Action::class,10)->create(['hierarchy_id' => $hierarchy_id]);
        $response = $this->json('GET', '/api/hierarchy/'.$hierarchy_id.'/action');
        $response->assertStatus(200);
        $this->assertEquals($actions->count(), count($response->getOriginalContent()));
    }

    public function test_show_retrieves_a_single_action()
    {
        $hierarchy_id = $this->hierarchy->first()->id;
        $actions = factory(Action::class,10)->create(['hierarchy_id' => $hierarchy_id]);
        $response = $this->json('GET', '/api/hierarchy/'.$hierarchy_id.'/action/'. $actions->first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'hierarchy_id', 'level', 'description', 'fear_average'
        ]);
        $this->assertEquals($hierarchy_id, $response->getOriginalContent()->id);
        $this->assertEquals($actions->first()->id, $response->getOriginalContent()->action_id);
    }

    public function generateActionDescriptions($num_of_descriptions)
    {
        $actions = [];
        for($i = 1; $i <= $num_of_descriptions; $i++){
            $actions["description_" . "$i"] = $this->faker->sentence(6);
        }
        return $actions;
    }
}
