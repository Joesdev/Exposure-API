<?php

namespace App\Http\Controllers;

use App\Http\Resources\Action;
use App\Http\Resources\Hierarchy as HierarchyResource;
use App\Hierarchy;

class HierarchyController extends Controller
{

    public function index()
    {
        $hierarchies = Hierarchy::all();
        return HierarchyResource::collection($hierarchies);
    }

    public function store()
    {
        $hierarchy = Hierarchy::create(request()->all());
        return new HierarchyResource($hierarchy);
    }

    public function destroy(Hierarchy $hierarchy)
    {
        if($hierarchy->delete()){
            return new HierarchyResource($hierarchy);
        }
    }

    public function update(Hierarchy $hierarchy)
    {
        $hierarchy->update(request()->all());
        return new HierarchyResource($hierarchy);
    }

    public function show(Hierarchy $hierarchy)
    {
        return new HierarchyResource($hierarchy);
    }

    public function actions(Hierarchy $hierarchy)
    {
        $actions = $hierarchy->actions()->get();
        return Action::collection($actions);
    }
}
