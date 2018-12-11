<?php

namespace Tests\Unit;

use App\Action;
use App\User;
use App\Hierarchy;
use App\Page;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HierarchyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $users;
    protected $hierarchies;
    protected $user_count = 2;
    protected $num_hierarchies = 2;
    protected $user_a_hierarchy_ids = [];

    public function setUp()
    {
        parent::setUp();
        $this->users = factory(User::class,$this->user_count)->create();
        $this->hierarchies = $this->runHierarchyFactoriesForEveryUser($this->users,$this->num_hierarchies);
    }

    public function test_index_returns_all_rows_in_hierarchy_table()
    {
        $response = $this->json('GET','/api/hierarchies');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(4, count($response->getOriginalContent()));
    }

    public function test_store_saves_goal_and_user_id_columns_to_database()
    {
        $input = [
                'user_id' => 44,
                'goal' => 'Getting Success'
        ];
        $response = $this->json('POST', '/api/hierarchy', $input);
        $response->assertStatus(201);
        $this->assertDatabaseHas('hierarchies', $input);
    }

    public function test_destroy_removes_a_hierarchy_from_db()
    {
        $userHierarchyStartCount = $this->users->first()->countHierarchies();
        $hierarchy = $this->hierarchies[0][0];
        $response = $this->json('DELETE', "api/hierarchy/$hierarchy->id");
        $response->assertStatus(200);
        $this->assertEquals($userHierarchyStartCount - 1, $this->users->first()->countHierarchies());
    }

    public function test_destroy_returns_404_when_accessing_invalid_id()
    {
        $invalid_id = 44;
        $response = $this->json('DELETE', "api/hierarchy/$invalid_id");
        $response->assertStatus(404);
    }

    public function test_destroy_deletes_all_related_table_rows()
    {
        $hierarchy = $this->hierarchies[0][0];
        $actions = factory(Action::class,10)->create(['hierarchy_id' => $hierarchy->id]);
        factory(Page::class,5)->create(['action_id' => $actions->first()->id]);
        $response = $this->json('DELETE', "api/hierarchy/$hierarchy->id");
        //Hierarchy Deleted so all related rows in actions and pages should also be deleted
        $response->assertStatus(200);
        $this->assertEquals(3, Hierarchy::all()->count());
        $this->assertEquals(0, Action::all()->count());
        $this->assertEquals(0, Page::all()->count());
    }

    public function test_update_modifies_an_existing_hierarchy()
    {
        $hierarchy = $this->hierarchies[0][0];
        $inputs = [
            'user_id' => 44,
            'goal' => 'updated!'
        ];
        $response = $this->json('PATCH', "api/hierarchy/$hierarchy->id", $inputs);
        $response->assertStatus(200);
        $this->assertDatabaseHas('hierarchies', $inputs);
    }

    public function test_show_returns_a_single_hierarchy_based_on_an_id()
    {
        $users_related_hierarchy_id = $this->hierarchies[0][0]->id;
        $response = $this->actingAs($this->users->first())
                        ->json('GET',"api/hierarchy/$users_related_hierarchy_id" );
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertJsonStructure([
            'data' => [
                'user_id',
                'goal'
            ]
        ]);
    }

    public function test_actions_retrieves_all_actions_for_a_hierarchy()
    {
        $hierarchy_id = $this->hierarchies[0][0]->id;
        $actions = factory(Action::class,10)->create(['hierarchy_id' => $hierarchy_id]);
        $response = $this->json('GET', 'api/hierarchy/'.$hierarchy_id.'/actions');
        $response->assertStatus(200);
        $this->assertEquals($actions->count(), count($response->getOriginalContent()));
        $response->assertJsonStructure([
            'data' => [[
                'hierarchy_id', 'level', 'description', 'fear_average'
            ]]
        ]);
    }

    public function getUserHierarchyIdsAsArray($user_id)
    {
        $id_array = User::find($user_id)->hierarchies()->get()->map(function($hierarchy) {
            return $hierarchy->id;
        })->all();
        return $id_array;
    }

    public function runHierarchyFactoriesForEveryUser($users, $num_hierarchies)
    {
        $hierarchies = [];
        foreach($users as $user){
            array_push($hierarchies, factory(Hierarchy::class, $num_hierarchies)->create(['user_id' => $user->id]));
        }
        return $hierarchies;
    }
}
