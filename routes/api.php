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
Route::get('/hierarchies', 'HierarchyController@index');
Route::post('/hierarchy', 'HierarchyController@store');
Route::get('/hierarchy/{hierarchy}', 'HierarchyController@show');
Route::patch('/hierarchy/{hierarchy}', 'HierarchyController@update');
Route::delete('/hierarchy/{hierarchy}', 'HierarchyController@destroy');
Route::get('/hierarchy/{hierarchy}/actions', 'HierarchyController@actions');

//Action
Route::get('/actions', 'ActionController@index');
Route::post('/action', 'ActionController@store');// Refactor to /action?hierarchy_id={id}
Route::get('/action/{action}', 'ActionController@show');
Route::patch('/action/{action}', 'ActionController@update');
Route::delete('/action/{action}', 'ActionController@destroy');

//Page
Route::get('/pages', 'PageController@index');
Route::post('/page', 'PageController@store');
Route::get('/page/{page}', 'PageController@show');
Route::patch('/page/{page}', 'PageController@update');
Route::delete('/page/{page}', 'PageController@destroy');


