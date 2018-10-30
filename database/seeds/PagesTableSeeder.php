<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\Action;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = Action::all();
        //For Every Row in Actions Table, Create 3 Pages
        foreach($actions as $action){
            $params['action_id'] = $action->id;
            factory(Page::class, 3)->create($params);
        }
    }
}
