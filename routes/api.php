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
Route::get('/hierarchy', 'HierarchyController@index')->name('hierarchy.index');
Route::post('/hierarchy', 'HierarchyController@store')->name('hierarchy.store');
Route::delete('/hierarchy/{hierarchy}', 'HierarchyController@destroy')->name('hierarchy.delete');
Route::patch('/hierarchy/{hierarchy}', 'HierarchyController@update')->name('hierarchy.update');
Route::get('/hierarchy/{hierarchy}', 'HierarchyController@show')->name('hierarchy.show');
Route::get('/hierarchy/{hierarchy}/actions', 'HierarchyController@actions')->name('hierarchy.actions');

//Action
Route::post('/hierarchy/{hierarchy}/action', 'ActionController@store')->name('action.store');// Refactor to /action?hierarchy_id={id}
Route::get('/action/{action}', 'ActionController@show')->name('action.show');

