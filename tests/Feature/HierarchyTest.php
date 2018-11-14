<?php

namespace Tests\Feature;

use App\Action;
use App\Hierarchy;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HierarchyTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_addAction_adds_a_row_to_actions_table_related_to_a_hierarchy_using_assoc_array()
    {
        $hierarchy = factory(Hierarchy::class)->create();
        $hierarchy->addAction([
            'level' => random_int(1,10),
            'description' => $this->faker->sentence(6,false)
        ]);
        $this->assertEquals(1, $hierarchy->countActions());
    }

    public function test_addAction_adds_a_row_to_actions_table_using_action_class()
    {
        $hierarchy = factory(Hierarchy::class)->create();
        $action = factory(Action::class,1)->create();
        $hierarchy->addAction($action);
        $this->assertEquals(1, $hierarchy->countActions());

        $action2 = factory(Action::class,1)->create();
        $hierarchy->addAction($action2);
        $this->assertEquals(2, $hierarchy->countActions());
    }

    public function test_addAction_adds_rows_to_database_using_collection_of_actions()
    {
        $hierarchy = factory(Hierarchy::class)->create();
        $actions = factory(Action::class,4)->create();
        $hierarchy->addAction($actions);
        $this->assertEquals(4, $hierarchy->countActions());
    }

    public function test_addAction_throws_exception_when_count_exceeds_ten()
    {
        $hierarchy = factory(Hierarchy::class)->create();
        $actions = factory(Action::class,10)->create();
        $hierarchy->addAction($actions);

        $this->assertEquals(10, $hierarchy->countActions());
        $this->expectException('Exception');
        $hierarchy->addAction([
            'level' => 11,
            'description' => $this->faker->sentence(6,false)
        ]);
    }


}
