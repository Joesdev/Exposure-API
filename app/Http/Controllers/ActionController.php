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

    public function storeMany(Request $request, $id)
    {
        $data = array(
            array('hierarchy_id' => $id, 1, $request->description_one),
            array('hierarchy_id' => $id, 2, $request->description_two),
            array('hierarchy_id' => $id, 3, $request->description_three),
            array('hierarchy_id' => $id, 4, $request->description_four),
            array('hierarchy_id' => $id, 5, $request->description_five),
            array('hierarchy_id' => $id, 6, $request->description_six),
            array('hierarchy_id' => $id, 7, $request->description_seven),
            array('hierarchy_id' => $id, 8, $request->description_eight),
            array('hierarchy_id' => $id, 9, $request->description_nice),
            array('hierarchy_id' => $id, 10, $request->description_ten),
        );
        Action::insert($data);
    }
}
