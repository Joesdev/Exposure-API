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
