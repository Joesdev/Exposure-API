<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Action;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Auth::user()->actions()->get();
        return view('home')->with(compact($actions, 'actions'));
    }


    public function saveAction(Request $request)
    {
        $user_id = Auth::user()->id;
        $action = new Action();
        $action->user_id = $user_id;
        $action->fear_level = $request->fear_level;
        $action->description = $request->action;
        $action->save();
        return redirect('home');
    }
}
