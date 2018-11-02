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
Route::post('/action/{hierarchy_id}', 'ActionController@storeMany')->name('store.actions');
