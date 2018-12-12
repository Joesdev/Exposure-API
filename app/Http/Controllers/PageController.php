<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Http\Resources\Page as PageResource;

use App\Page;

class PageController extends Controller
{
    public function index()
    {
        return PageResource::collection(Page::all());
    }

    public function store(PageStoreRequest $request)
    {
        if(request()->has('actionId')){
            $inputs = $request->validated();
            $inputs['action_id'] = request()->query('actionId');
            $page = Page::create($inputs);
            return new PageResource($page);
        }
    }

    public function show(Page $page)
    {
        return new PageResource($page);
    }

    public function update(Page $page, PageUpdateRequest $request)
    {
        $page->update($request->validated());
        return new PageResource($page);
    }

    public function destroy(Page $page)
    {
        if($page->delete()){
            return new PageResource($page);
        };
    }
}
