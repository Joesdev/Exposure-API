<?php

namespace Tests\Unit;

use App\User;
use App\Hierarchy;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function test_index_returns_multiple_hierarchies_for_a_user()
    {
        $response = $this->actingAs($this->users->first())
                        ->json('GET','/hierarchy');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(count($this->hierarchies[0]), count($response->getOriginalContent()));
    }

    public function test_show_returns_a_single_hierarchy_based_on_an_id()
    {
        $users_related_hierarchy_id = $this->hierarchies[0][0]->id;
        $response = $this->actingAs($this->users->first())
                        ->json('GET',"/hierarchy/$users_related_hierarchy_id" );
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertJsonStructure([
            'user_id',
            'goal'
        ]);
    }

    public function test_show_returns_404_error_when_passed_an_hierarchy_id_which_doesnt_belong_to_that_user()
    {
        $users_non_related_hierarchy_id = $this->hierarchies[1][0]->id;
        $response = $this->actingAs($this->users->first())
            ->json('GET',"/hierarchy/$users_non_related_hierarchy_id" );
        $response->assertStatus(404);
    }

    public function test_update_modifies_an_existing_hierarchy()
    {
        $hierarchy = $this->hierarchies[0][0];
        $goal = 'Updated!';
        $response = $this->actingAs($this->users->first())
                         ->json('PATCH', "/hierarchy/$hierarchy->id", ['goal' => $goal]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('hierarchies', [
            'id'      => $hierarchy->id,
            'user_id' => $hierarchy->user_id,
            'goal'    => $goal
        ]);
    }

    public function test_update_cannot_update_another_users_hierarchy()
    {
        $notThisUsershHierarchy = $this->hierarchies[1][0];
        $goal = 'Updated!';
        $response = $this->actingAs($this->users->first())
            ->json('PATCH', "/hierarchy/$notThisUsershHierarchy->id", ['goal' => $goal]);
        $response->assertStatus(404);
    }

    public function test_destroy_removes_a_hierarchy_from_db()
    {
        $userHierarchyStartCount = $this->users->first()->countHierarchies();
        $hierarchy = $this->hierarchies[0][0];
        $response = $this->actingAs($this->users->first())
                         ->json('DELETE', "/hierarchy/$hierarchy->id");
        $response->assertStatus(200);
        $this->assertEquals($userHierarchyStartCount - 1, $this->users->first()->countHierarchies());
    }

    public function test_destroy_returns_404_when_deleting_another_users_hierarchy()
    {
        $hierarchy = $this->hierarchies[1][0];
        $response = $this->actingAs($this->users->first())
            ->json('DELETE', "/hierarchy/$hierarchy->id");
        $response->assertStatus(404);
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
