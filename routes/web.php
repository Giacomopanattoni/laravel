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

Route::delete('/albums/{album}','AlbumsController@delete')->where('album','[0-9]+');

Route::get('/albums/{id}','AlbumsController@show')->where('id','[0-9]+');

Route::get('/albums/{id}/edit','AlbumsController@edit');

Route::get('/albums/create','AlbumsController@create')->name('album.create');

Route::post('/albums','AlbumsController@save')->name('album.save');

Route::patch('/albums/{id}','AlbumsController@store');

Route::get('/albums/{album}/images','AlbumsController@getImages')->name('album.getImages')->where('album','[0-9]+');

Route::resource('photos', 'PhotosController');

Route::get('/users', function(){
    return User::all();
});

Route::get('/photos', function(){ 
    return Photo::all();
})->name('photos.index');


/* 
* ritorna tutti gli utenti con un album
*/
Route::get('/usersnoalbum', function(){
    $usernoalbum = DB::table('users as u')
    ->leftJoin('albums as a', 'u.id','=', 'a.user_id')
    ->select('u.id', 'u.email', 'u.name','album_name')
    ->whereNull('album_name')
    ->get();  
    dd($usernoalbum);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
