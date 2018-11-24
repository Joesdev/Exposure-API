<?php

namespace App\Http\Controllers;

use App\Action;
use App\Hierarchy;
use Validator;

class ActionController extends Controller
{

    public function index(Hierarchy $hierarchy)
    {
        $actions = $hierarchy->actions()->get();
        return $actions;
    }

    public function store(Hierarchy $hierarchy)
    {
        $hierarchy->addAction(request(['level', 'description']));
    }

    public function create()
    {
        return view('test_forms.action_create');
    }

    public function show(Action $action)
    {
        return $action;
    }

    public function update(Action $action)
    {

        $validator->make('action', 'post');
        $rules = [
            'description'  => 'required_without:fear_average|min:5|max:60'
        ];
        $messages = [
            'required_without' => 'The :attribute field is required'
        ];
        $validator = Validator::make(request()->only(['description', 'fear_average']), $rules, $messages);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }else{
            $action->update(request()->only(['description', 'fear_average']));
            return $action;
        }
    }
}
