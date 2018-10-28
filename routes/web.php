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

//Routes Which Return Views
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

//Actions
Route::post('/home/action', 'HomeController@saveAction');


Route::get('/test/user/hierarchy', function(){
   $user = \App\User::find(1)->hierarchies;
   dd($user);
});