<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Hierarchy;

class HierarchyController extends Controller
{

    public function index()
    {
        $hierarchies = Hierarchy::all();
        return $hierarchies;
    }

    public function store()
    {
        $hierarchy = Hierarchy::create(request()->all());
        return $hierarchy;
    }

    public function create()
    {
        return view('test_forms.hierarchy_create');
    }

    public function update(Hierarchy $hierarchy)
    {
        $this->verifyUserOwnsAHierarchy($hierarchy);
        $hierarchy->update(request()->all());
    }

    public function show(Hierarchy $hierarchy)
    {
        return $hierarchy;
    }

    public function edit(Hierarchy $hierarchy)
    {
        return view('test_forms.hierarchy_edit', compact('hierarchy'));
    }

    public function destroy(Hierarchy $hierarchy)
    {
        $this->verifyUserOwnsAHierarchy($hierarchy);
        $hierarchy->delete();
    }

    public function actions(Hierarchy $hierarchy)
    {
        $actions = $hierarchy->actions()->get();
        return $actions;
    }

    public function verifyUserOwnsAHierarchy(Hierarchy $hierarchy)
    {
        ($hierarchy->user_id != Auth::id()) ? abort(404) : true;
    }
}
