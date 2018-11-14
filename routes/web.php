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
Route::get('/hierarchy', 'HierarchyController@index')->name('hierarchy.index');
Route::post('/hierarchy', 'HierarchyController@store')->name('hierarchy.store');
Route::get('/hierarchy/create', 'HierarchyController@create')->name('hierarchy.create');
Route::get('/hierarchy/{hierarchy}', 'HierarchyController@show')->name('hierarchy.show');
Route::patch('/hierarchy/{hierarchy}', 'HierarchyController@update')->name('hierarchy.update');
Route::get('/hierarchy/{hierarchy}/edit', 'HierarchyController@edit')->name('hierarchy.edit');
