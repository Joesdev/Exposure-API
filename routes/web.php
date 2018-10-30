<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth
Auth::routes();

//General Navigation
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

//Hierarchy
Route::post('/hierarchy', 'HierarchyController@store')->name('store.hierarchy');

//Hierarchy/Action
Route::post('/actions/{hierarchy_id}', 'ActionController@storeMany')->name('store.actions');