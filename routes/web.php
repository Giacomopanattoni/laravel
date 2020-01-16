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

use App\Models\Album;
use App\Models\Photo;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/albums','AlbumsController@index');
Route::get('/albums/{id}/delete','AlbumsController@delete');


Route::get('/users', function(){
    return User::all();
});

Route::get('/photos', function(){
    return Photo::all();
});
