<?php

namespace App\Http\Controllers;

use App\Action;
use App\Hierarchy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function storeMany(Request $request, $hierearchy_id)
    {
        $hierarchy = Hierarchy::where('id', $hierearchy_id)->first();
        $data = array(
            array('hierarchy_id' => $hierarchy->id, 'level' => 1, 'description' => $request->description_one),
            array('hierarchy_id' => $hierarchy->id, 'level' => 2, 'description' => $request->description_two),
            array('hierarchy_id' => $hierarchy->id, 'level' => 3, 'description' => $request->description_three),
            array('hierarchy_id' => $hierarchy->id, 'level' => 4, 'description' => $request->description_four),
            array('hierarchy_id' => $hierarchy->id, 'level' => 5, 'description' => $request->description_five),
            array('hierarchy_id' => $hierarchy->id, 'level' => 6, 'description' => $request->description_six),
            array('hierarchy_id' => $hierarchy->id, 'level' => 7, 'description' => $request->description_seven),
            array('hierarchy_id' => $hierarchy->id, 'level' => 8, 'description' => $request->description_eight),
            array('hierarchy_id' => $hierarchy->id, 'level' => 9, 'description' => $request->description_nine),
            array('hierarchy_id' => $hierarchy->id, 'level' => 10, 'description' => $request->description_ten),
        );
        Action::insert($data);
    }
}
