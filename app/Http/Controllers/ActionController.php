<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionStoreRequest;
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

    public function store(ActionStoreRequest $request)
    {
        if(request()->has('hierarchy_id')){
            $hierarchy = Hierarchy::find(request()->hierarchy_id);
            $hierarchy = $hierarchy->addAction($request->validated());
            return $hierarchy;
        };
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
