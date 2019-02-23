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

Route::get('/map', 'HomeController@getMap')->name('getmap');

//Ordre status. Søk opp et ordrenummer og få informasjon om det.
Route::get('/orderstatus', 'HomeController@getOrderStatus')->name('orderstatus');

//Prototype kjørekontor midlertidig rute
Route::get('/prototest', 'HomeController@getPrototest')->name('proto.prototest');
Route::get('/prototest2', 'HomeController@getPrototest2')->name('proto.prototest2');

Route::get('/protohome', 'HomeController@getPrototestHome')->name('proto.prototesthome');

Route::get('/protoworkshops', 'HomeController@getProtoWorkshops')->name('proto.protoworkshop');
Route::get('/protoworkshopscreate', 'HomeController@getProtoWorkshopCreate')->name('proto.protoworkshopcreate');

Route::get('/protoroles', 'HomeController@getProtoRoles')->name('proto.protoroles');

Route::get('/orders', 'HomeController@getOrders')->name('getorders');

//Search workshops ajax
Route::get('/searchworkshops', 'HomeController@searchWorkshops');


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


Route::get('/timeseed', 'RouteTimesController@timeseed');

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

Route::post('/route-endkm', 'HomeController@setRouteEndKm')->name('transport.route-setendkm');
//route-report


Route::get('/route-report', 'HomeController@getRouteReport')->name('transport.route-report');

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

//Check if the workshop number exists and what name it has
Route::get('/getworkshopinfo', 'HomeController@getWorkshopInfo');

//set driver for route
Route::get('/setdriver', 'HomeController@setDriver')->name('setdriver');

Route::get('/setactive', 'HomeController@setActive')->name('setactive');

Route::get('/setinactive', 'HomeController@setInactive')->name('setinactive');


Route::get('/optimize', 'HomeController@optimize')->name('optimize');


Route::post('/markdel', 'HomeController@markdelivered')->name('markdelivered');
Route::post('/undokdel', 'HomeController@undodelivered')->name('undodelivered');

