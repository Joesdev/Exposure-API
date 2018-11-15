<?php

namespace App\Http\Controllers;

use App\Hierarchy;

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

    public function show()
    {

    }
}
