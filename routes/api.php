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
Route::get('/hierarchies', 'HierarchyController@index')->name('hierarchy.index');
Route::post('/hierarchy', 'HierarchyController@store')->name('hierarchy.store');
Route::get('/hierarchy/{hierarchy}', 'HierarchyController@show')->name('hierarchy.show');
Route::patch('/hierarchy/{hierarchy}', 'HierarchyController@update')->name('hierarchy.update');
Route::delete('/hierarchy/{hierarchy}', 'HierarchyController@destroy')->name('hierarchy.delete');
Route::get('/hierarchy/{hierarchy}/actions', 'HierarchyController@actions')->name('hierarchy.actions');

//Action
Route::post('/action', 'ActionController@store')->name('action.store');// Refactor to /action?hierarchy_id={id}
Route::get('/action/{action}', 'ActionController@show')->name('action.show');
Route::patch('/action/{action}', 'ActionController@update')->name('action.update');
Route::delete('/action/{action}', 'ActionController@destroy')->name('action.delete');

//Pages
Route::post('/page', 'PageController@store')->name('page.show');


