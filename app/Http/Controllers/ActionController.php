<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function storeTen(Request $request, $hierarchy_id)
    {
        $data = array(
            array('hierarchy_id' => $hierarchy_id, 'level' => 1, 'description' => $request->description_1),
            array('hierarchy_id' => $hierarchy_id, 'level' => 2, 'description' => $request->description_2),
            array('hierarchy_id' => $hierarchy_id, 'level' => 3, 'description' => $request->description_3),
            array('hierarchy_id' => $hierarchy_id, 'level' => 4, 'description' => $request->description_4),
            array('hierarchy_id' => $hierarchy_id, 'level' => 5, 'description' => $request->description_5),
            array('hierarchy_id' => $hierarchy_id, 'level' => 6, 'description' => $request->description_6),
            array('hierarchy_id' => $hierarchy_id, 'level' => 7, 'description' => $request->description_7),
            array('hierarchy_id' => $hierarchy_id, 'level' => 8, 'description' => $request->description_8),
            array('hierarchy_id' => $hierarchy_id, 'level' => 9, 'description' => $request->description_9),
            array('hierarchy_id' => $hierarchy_id, 'level' => 10, 'description' => $request->description_10),
        );
        Action::insert($data);
    }

    public function store(Request $request, $hierarchy_id)
    {
        $action = new Action();
        $action->hierarchy_id = $hierarchy_id;
        $action->level = $request->level;
        $action->description = $request->description;
        $action->save();
    }
}
