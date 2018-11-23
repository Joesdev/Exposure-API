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


Route::delete('/hierarchy/{hierarchy}', 'HierarchyController@destroy')->name('hierarchy.delete');
Route::get('/hierarchy/create', 'HierarchyController@create')->name('hierarchy.create');
Route::patch('/hierarchy/{hierarchy}', 'HierarchyController@update')->name('hierarchy.update');
Route::get('/hierarchy/{hierarchy}/edit', 'HierarchyController@edit')->name('hierarchy.edit');
