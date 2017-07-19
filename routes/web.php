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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', 'Controller@auth');

Route::resource('/lists', 'ListController');
Route::resource('/lists/{listId}/members', 'MemberController');
// Route::get('/{apiKey}', 'Controller@data');
// Route::resource('/{apiKey}/lists', 'ListController');
// Route::resource('/{apiKey}/lists/{listId}/members', 'MemberController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
