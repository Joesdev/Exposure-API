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

    public function destroy(Hierarchy $hierarchy)
    {
        if($hierarchy->delete()){
            return $hierarchy;
        }
    }

    public function update(Hierarchy $hierarchy)
    {
        $hierarchy->update(request()->all());
        return $hierarchy;
    }

    public function show(Hierarchy $hierarchy)
    {
        return $hierarchy;
    }

    public function edit(Hierarchy $hierarchy)
    {
        return view('test_forms.hierarchy_edit', compact('hierarchy'));
    }

    public function actions(Hierarchy $hierarchy)
    {
        $actions = $hierarchy->actions()->get();
        return $actions;
    }
}
