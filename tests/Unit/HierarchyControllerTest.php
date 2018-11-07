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

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Hierarchy::class, 2)->create(['user_id' => $this->user->id]);
    }

    /*public function test_index_returns_multiple_hierarchies_for_a_user()
    {
        $response = $this->actingAs($this->user)
                        ->json('GET','/api/hierarchy');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response->getOriginalContent()));
    }*/

    public function test_show_returns_a_single_hierarchy_based_on_an_id()
    {
        dd(User::all());
        $hierarchy_id = 2;
        $response = $this->actingAs($this->user)
                        ->json('GET','/api/hierarchy/' . $hierarchy_id);
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertJsonStructure(['user_id', 'goal']);
    }
}
