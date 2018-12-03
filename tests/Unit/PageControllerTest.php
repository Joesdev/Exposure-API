<?php

namespace Tests\Unit;

use App\Hierarchy;
use App\Action;
use App\Page;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $hierarchy;
    protected $action;
    protected $page;

    public function setUp()
    {
        parent::setUp();
        $this->hierarchy = factory(Hierarchy::class)->create(['user_id' => 1]);
        $this->action = factory(Action::class)->create(['hierarchy_id' => $this->hierarchy->id]);
        $this->page = factory(Page::class)->create(['action_id' => $this->action->id]);
    }

    public function test_store_creates_a_page_row_in_pages_table()
    {
        $fields = $this->validFields();
        $response = $this->json('POST', "api/page?actionId=" . $this->action->id,
            $fields);
        $response->assertStatus(201);
        $this->assertDatabaseHas( 'pages', $fields);
    }

    public function test_store_returns_json_errors_for_descriptions_too_long_or_empty()
    {
        $fields = $this->validFields(['description' => str_repeat('.',160)]);
        $response = $this->json('POST', "api/page?actionId=" . $this->action->id,
            $fields);
        $response->assertJsonValidationErrors('description');

        $fields = $this->validFields(['description' => ""]);
        $response = $this->json('POST', "api/page?actionId=" . $this->action->id,
            $fields);
        $response->assertJsonValidationErrors('description');
    }

    public function test_store_returns_json_errors_for_numeric_fields_whos_input_is_outside_range_one_to_ten()
    {
        $fields = $this->validFields([
            'fear_before' => -1,
            'fear_during' => 11,
            'satisfaction' => 99
        ]);
        $response = $this->json('POST', "api/page?actionId=" . $this->action->id,
            $fields);
        $response->assertJsonValidationErrors(['fear_before','fear_during', 'satisfaction']);
    }

    public function test_update_modifies_all_fields_except_action_id()
    {
        $valid_fields = $this->validFields();
        $response = $this->json('PATCH', '/api/page/'. $this->page->id, $valid_fields);
        $response->assertStatus(200);
        $this->assertDatabaseHas('pages', $valid_fields);
    }

    public function test_update_returns_json_error_when_modifying_action_id()
    {
        $valid_fields = $this->validFields(['action_id' => $this->action->id]);
        $response = $this->json('PATCH', '/api/page/'. $this->page->id, $valid_fields);
        $response->assertJsonValidationErrors('action_id');
    }

    public function test_destroy_removes_a_row_from_database_and_returns_formatted_data_without_updated_or_created_at()
    {
        $response = $this->json('DELETE', '/api/page/' . $this->page->id);
        $response->assertStatus(200);
        $response->assertJson($this->getDataInResourceFormat());
        $this->assertDatabaseMissing('pages' , $this->page->toArray());
    }

    public function test_destroy_returns_an_error_message_when_accessing_a_row_that_does_not_exit()
    {
        $response = $this->json('DELETE', '/api/page/' . 99);
        $response->assertStatus(404);
        $response->assertJson(['errors' => 'Model Not Found']);
    }

    public function validFields($overrides= []){
        return array_merge([
            'description'  => $this->faker()->sentence(15),
            'fear_before'  => $this->faker()->numberBetween(7,9),
            'fear_during'  => $this->faker()->numberBetween(5,7),
            'satisfaction' => $this->faker()->numberBetween(5,10)
        ], $overrides);
    }

    public function getDataInResourceFormat($overrides = [])
    {
        $data = array_merge([
            'action_id'    => $this->page->action_id,
            'text'         => $this->page->description,
            'fear_before'  => $this->page->fear_before,
            'fear_during'  => $this->page->fear_during,
            'satisfaction' => $this->page->satisfaction
        ], $overrides);
        return ['data' => $data];
    }
}
