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
        factory(User::class, 5)->create()->each(function ($u){
            $u->hierarchies()->save(factory(Hierarchy::class)->make([
                'user_id' => $u->id
            ]));
        });
    }
}
