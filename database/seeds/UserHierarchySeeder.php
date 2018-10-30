<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Hierarchy;

class UserHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 Users, Each Owning a Single Hierarchy
        factory(User::class, 5)->create()->each(function ($u){
            $u->hierarchies()->save(factory(Hierarchy::class)->make([
                'user_id' => $u->id
            ]));
        });

        // Create 2 Users, Each Owning Two Hierarchies
        factory(User::class, 2)->create()->each(function ($u){
            for($count = 0; $count < 2; $count++){
                $u->hierarchies()->save(factory(Hierarchy::class)->make([
                    'user_id' => $u->id
                ]));
            }
        });
    }
}
