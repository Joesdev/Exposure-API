<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionUpdateRequest;

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

    public function store()
    {
        if(request()->has('hierarchy_id')){

        };
        $hierarchy->addAction(request(['level', 'description']));
    }

    public function show(Action $action)
    {
        return $action;
    }

    public function update(Action $action, ActionUpdateRequest $request)
    {
        $action->update($request->validated());
        return $action;
    }

    public function destroy(Action $action)
    {
        if($action->delete()) {
            return $action;
        }
    }
}
