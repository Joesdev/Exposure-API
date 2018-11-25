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

    public function store(Hierarchy $hierarchy)
    {
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
        return $action;
    }
}
