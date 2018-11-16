<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Hierarchy
Route::get('/hierarchy/{hierarchy}', 'HierarchyController@show')->name('hierarchy.show');
Route::get('/hierarchy/{hierarchy}/actions', 'HierarchyController@actions')->name('hierarchy.actions');

//Action
Route::post('/hierarchy/{hierarchy}/action', 'ActionController@store')->name('action.store');
/*Route::get('/hierarchy/{hierarchy}/action/create', 'ActionController@create');*/

Route::get('/action/{action}', 'ActionController@show')->name('action.show');
Route::patch('/action/{action}');
Route::delete('/action/{action}');