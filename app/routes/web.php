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



Route::get('/boot', function(){
   return view('boostraptesting');
});

//Thomas Laraveltest
Route::get('/thomas', function(){
   return view('thomas');
});

Auth::routes();

//Force login if you are not before
Route::get('/', 'HomeController@index')->name('home');

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



//home
//Route::get('/home', 'HomeController@getTransportHome')->name('transport.home');

//route-preview
Route::get('/route-preview', 'HomeController@getRoutePreview')->name('transport.route-preview');

//route-endkm

//route-startkm
Route::get('/route-startkm', 'HomeController@getRouteStartKm') ->name('transport.route-startkm');
Route::post('/route-startkm', 'HomeController@setRouteStartKm') ->name('transport.route-setstartkm');

//Route-endKm
Route::get('/route-endkm', 'HomeController@getRouteEndKm')->name('transport.route-endkm');
//route-report
Route::get('transport/route-report', 'HomeController@getRouteReport')->name('transport.route-report');

//route-drive
Route::get('/route-drive', 'HomeController@getRouteDrive')->name('transport.route-drive');

//end Transport routes

//Roles test attaching admin role
Route::get('/attachadmin/{id}', 'HomeController@attachAdmin');

//Roles test attaching user role
Route::get('/attachuser/{id}', 'HomeController@attachUser');

//Roles test attaching office role
Route::get('/attachoffice/{id}', 'HomeController@attachOffice');

/*
 *  Office roles
 * */

Route::get('/userroles', 'HomeController@userRoles')->name('office.userroles');

Route::get('/edituser/{id}', 'HomeController@editUser')->name('office.edituser');

Route::post('/storeedituser', 'HomeController@storeEditUser')->name('office.storeedituser');

/*
 * Workshops
 * */

Route::get('/workshops', 'HomeController@getWorkshops')->name('office.workshops');

Route::get('/workshops/create', 'HomeController@getCreateWorkshops')->name('office.workshops.create');

Route::post('/workshops/create', 'HomeController@storeCreate')->name('office.storecreate');

//search autocomplete
Route::get('/autocomplete/{session}/{query}', 'HomeController@searchGoogleAutocomplete');
//search places api
Route::get('/searchplacesapi', 'HomeController@searchplacesapi');


/*
 *  Office routes
 * */

Route::get('/routes', 'HomeController@getRoutes')->name('office.routes');

Route::post('/postroute', 'HomeController@postRoute')->name('office.postroute');


//set driver for route
Route::get('/setdriver', 'HomeController@setDriver')->name('setdriver');

Route::get('/setactive', 'HomeController@setActive')->name('setactive');

Route::get('/setinactive', 'HomeController@setInactive')->name('setinactive');


Route::get('/optimize', 'HomeController@optimize')->name('optimize');


Route::post('/markdel', 'HomeController@markdelivered')->name('markdelivered');
Route::post('/undokdel', 'HomeController@undodelivered')->name('undodelivered');
