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

Route::get('/boot', function(){
   return view('boostraptesting');
});

//Thomas Laraveltest
Route::get('/thomas', function(){
   return view('thomas');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/proto', function(){
   return view('proto');
})->name('proto');

Route::get('/drive', function(){
    return view('drive');
})->name('drive');

Route::get('/drivestart', function(){
    return view('drivestart');
})->name('drivestart');

Route::get('/map', function(){
   return view('map');
})->name('map');