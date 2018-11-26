<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagePostRequest;
use App\Http\Resources\Page as PageResource;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public function store(PagePostRequest $request)
    {
        if(request()->has('actionId')){
            $inputs = $request->validated();
            $inputs['action_id'] = request()->query('actionId');
            $page = Page::create($inputs);
            return new PageResource($page);
        }
    }
}
