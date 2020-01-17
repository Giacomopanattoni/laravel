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
})->name('home');

Route::get('/albums','AlbumsController@index')->name('albums');

Route::delete('/albums/{id}','AlbumsController@delete');

Route::get('/albums/{id}','AlbumsController@show')->where('id','[0-9]+');

Route::get('/albums/{id}/edit','AlbumsController@edit');

Route::get('/albums/create','AlbumsController@create')->name('album.create');

Route::post('/albums','AlbumsController@save')->name('album.save');

Route::patch('/albums/{id}','AlbumsController@store');


Route::get('/users', function(){
    return User::all();
});

Route::get('/photos', function(){
    return Photo::all();
});
