<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionStoreRequest;
use App\Http\Requests\ActionUpdateRequest;
use App\Http\Resources\Action as ActionResource;

use App\Action;
use App\Hierarchy;
use Validator;

class ActionController extends Controller
{

    public function index()
    {
        return ActionResource::collection(Action::all());
    }

    public function store(ActionStoreRequest $request)
    {
        if(request()->has('hierarchy_id')){
            $hierarchy = Hierarchy::find(request()->hierarchy_id);
            $action = $hierarchy->addAction($request->validated());
            return new ActionResource($action);
        };
    }

    public function show(Action $action)
    {
        return new ActionResource($action);
    }

    public function update(Action $action, ActionUpdateRequest $request)
    {
        $action->update($request->validated());
        return new ActionResource($action);
    }

    public function destroy(Action $action)
    {
        if($action->delete()) {
            return new ActionResource($action);
        }
    }
}
