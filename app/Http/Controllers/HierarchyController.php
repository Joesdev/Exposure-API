<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Hierarchy;

class HierarchyController extends Controller
{

    public function store()
    {
        Hierarchy::create([
            'user_id' => Auth::id(),
            'goal' => request('goal')
        ]);
    }

    public function update(Hierarchy $hierarchy)
    {
        $this->verifyUserOwnsAHierarchy($hierarchy);
        $hierarchy->update(request()->all());
    }

    public function index()
    {
        $hierarchies = Hierarchy::where('user_id', Auth::id())->get();
        return $hierarchies;
    }

    public function show(Hierarchy $hierarchy)
    {
        $this->verifyUserOwnsAHierarchy($hierarchy);
        return $hierarchy;
    }

    public function create()
    {
        return view('test_forms.hierarchy_create');
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

    public function verifyUserOwnsAHierarchy(Hierarchy $hierarchy)
    {
        ($hierarchy->user_id != Auth::id()) ? abort(404) : true;
    }
}
