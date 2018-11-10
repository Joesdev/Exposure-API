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

    public function index()
    {
        $hierarchies = Hierarchy::where('user_id', Auth::id())->get();
        return $hierarchies;
    }

    public function show(Hierarchy $hierarchy)
    {
        return $hierarchy;
    }

    public function create()
    {
        return view('test_forms.hierarchy_create');
    }
}
