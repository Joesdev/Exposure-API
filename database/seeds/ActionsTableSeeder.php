<?php

use Illuminate\Database\Seeder;
use App\Action;
use App\Hierarchy;
class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hierarchies = Hierarchy::all();
        // Retrieve All Hierarchies and Create 10 Actions For Each
        foreach($hierarchies as $hierarchy){
            for($count = 1; $count <= 10; $count++){
                $params = [
                    'hierarchy_id' => $hierarchy->id,
                    'level'        => $count
                ];
                factory(Action::class, 1)->create($params);
            }
        }
    }
}
