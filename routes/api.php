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
Route::post('/hierarchy', 'HierarchyController@store')->name('store.hierarchy');

//Action
Route::post('/hierarchy/{hierarchy_id}/actions', 'ActionController@storeTen')->name('store.actions');
Route::post('/hierarchy/{hierarchy_id}/action', 'ActionController@store')->name('store.action');
