<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hierarchy;

class HierarchyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function store(Request $request)
    {
        $hierarchy = new Hierarchy();
        $hierarchy->user_id = Auth::user()->id;;
        $hierarchy->goal = $request->goal;
        $hierarchy->save();
    }

    public function index()
    {
        $user = Auth::user();
        $hierarchies = Hierarchy::where('user_id', $user->id)->get();
        return $hierarchies;
    }

    public function show($id)
    {
        $user = Auth::user();
        $hierarchy = Hierarchy::findOrFail($id);
        return $hierarchy;
    }
}
