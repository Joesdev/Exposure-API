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

//Action
Route::post('/hierarchy/{id}/actions', 'ActionController@storeTen')->name('store.actions');
Route::post('/hierarchy/{id}/action', 'ActionController@store')->name('store.action');
