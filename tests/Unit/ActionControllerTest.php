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
            ->json('POST', "/api/action?hierarchy_id=$hierarchy_id", [
                'level' => $level,
                'description' => implode($description)
            ]);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertDatabaseHas('actions', [
            'hierarchy_id' => $hierarchy_id,
            'level' => $level,
            'description' => $description
        ]);
    }

    public function test_store_fails_validation_for_description_and_level_over_max()
    {

        $response = $this->json('POST', "/api/action?hierarchy_id=" . $this->hierarchy->first()->id, [
                'level' => 11,
                'description' => str_repeat('.',75)
        ]);
        $response->assertJsonValidationErrors(['level', 'description']);
    }

    public function test_store_fails_validation_for_description_and_level_under_min_and_required()
    {
        $response = $this->json('POST', "/api/action?hierarchy_id=" . $this->hierarchy->first()->id, [
            'level' => 0,
            'description' => str_repeat('.',4)
        ]);
        $response->assertJsonValidationErrors(['level', 'description']);
        $response = $this->json('POST', "/api/action?hierarchy_id=" . $this->hierarchy->first()->id);
        $response->assertJsonValidationErrors(['level', 'description']);
    }

    public function test_show_retrieves_a_single_action()
    {
        $hierarchy_id = $this->hierarchy->first()->id;
        $actions = factory(Action::class,3)->create(['hierarchy_id' => $hierarchy_id]);
        $response = $this->json('GET', 'api/action/'. $actions->first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'hierarchy_id', 'level', 'description', 'fear_average'
        ]);
        $this->assertEquals($hierarchy_id, $response->getOriginalContent()->hierarchy_id);
        $this->assertEquals($actions->first()->id, $response->getOriginalContent()->id);
    }

    public function test_update_modifies_description_of_an_action()
    {
        $action = factory(Action::class)->create(['hierarchy_id' => $this->hierarchy->first()->id]);
        $new_description = 'updated description';
        $fear_average = 0.5;
        $response = $this->json('PATCH', "api/action/$action->id", [
            'description' => $new_description,
            'fear_average'=> $fear_average
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('actions', [
            'id' => $action->id,
            'description' => $new_description,
            'fear_average' => $fear_average
        ]);
    }

    public function test_update_returns_status_422_for_description_thats_too_long()
    {
        $description = 'This description is supposed to be limited to 50 characters, Im close to 70.';
        $action = factory(Action::class)->create(['hierarchy_id' => $this->hierarchy->first()->id]);
        $response = $this->json('PATCH', "api/action/$action->id", [
            'description' => $description,
        ]);
        $this->assertValidationErrorsForFieldWithStatus($response, 'description', 422);
    }

    public function test_update_returns_422_and_error_for_description_required_field()
    {
        $description = '';
        $action = factory(Action::class)->create(['hierarchy_id' => $this->hierarchy->first()->id]);
        $response = $this->json('PATCH', "api/action/$action->id", [
            'description' => $description,
        ]);
        $this->assertValidationErrorsForFieldWithStatus($response, 'description', 422);
    }

    public function test_destroy_deletes_an_action_row()
    {
        $action = factory(Action::class)->create(['hierarchy_id' => $this->hierarchy->first()->id]);
        $this->assertDatabaseHas('actions', ['id' => $action->id]);
        $response = $this->json('DELETE', "/api/action/$action->id");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('actions', [ 'id' => $action->id ]);
    }

    public function assertValidationErrorsForFieldWithStatus($response, $key, $status)
    {
        $response->assertStatus($status);
        $response->assertJsonValidationErrors($key);
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
