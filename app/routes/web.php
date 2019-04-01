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


/*
|--------------------------------------------------------------------------
| Dashboard routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/


Route::get('/dashboard', 'AnalyticsController@getDashboard')->name('dashboard');
Route::get('/dataexport', 'AnalyticsController@getDataexport')->name('dataexport');


//-------END OF SECTION-----------------------------------------------------


/*
|--------------------------------------------------------------------------
| Routes routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/

Route::get('/routes', 'RouteController@getRoutes')->name('routes');

Route::post('/postroute', 'RouteController@postRoute')->name('office.postroute');

Route::post('/posthente', 'RouteController@postHente')->name('office.posthente');

//Check if the workshop number exists and what name it has
Route::get('/getworkshopinfo', 'RouteController@getWorkshopInfo');

//set driver for route
Route::get('/setdriver', 'RouteController@setDriver')->name('setdriver');

Route::get('/setactive', 'RouteController@setActive')->name('setactive');

Route::get('/setinactive', 'RouteController@setInactive')->name('setinactive');

//Edit order
Route::get('/editorder', 'RouteController@getEdit')->name('getedit');
Route::post('/postedit', 'RouteController@postEdit')->name('postedit');


//-------END OF SECTION-----------------------------------------------------


/*
|--------------------------------------------------------------------------
|  RouteTimes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/


Route::get('/routetimes', 'RouteTimesController@getRoutetimes')->name('routetimes');

Route::get('/editroutetimes', 'RouteTimesController@getEditRouteTimes')->name('editroutetimes');

Route::get('/createroutetimes', 'RouteTimesController@getCreateRouteTimes')->name('createroutetimes');

Route::post('/createroutetimes', 'RouteTimesController@postcreateroutetime')->name('postcreateroutetime');

Route::post('/deleteroutetimes', 'RouteTimesController@deleteroutetimes')->name('deleteroutetimes');

Route::post('/postroutetimeedit', 'RouteTimesController@postroutetimeedit')->name('postroutetimeedit');

Route::get('/timeseed', 'RouteTimesController@timeseed');


//-------END OF SECTION-----------------------------------------------------


/*
|--------------------------------------------------------------------------
| Workshop routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/

Route::get('/workshops', 'WorkshopController@getWorkshops')->name('proto.protoworkshop');
Route::get('/workshops/create', 'WorkshopController@getWorkshopCreate')->name('proto.protoworkshopcreate');
Route::post('/workshops/create', 'WorkshopController@storeCreateWorkshop')->name('office.storecreate');

Route::get('/workshop/edit', 'WorkshopController@getEditWorkshop')->name('editworkshop');
Route::post('/workshop/edit', 'WorkshopController@postworkshopedit')->name('postworkshopedit');

//Search workshops ajax
Route::get('/searchworkshops', 'WorkshopController@searchWorkshops');

//Sortert rekkefølge
Route::get('/prioritize', 'WorkshopController@prioritize')->name('prioritize');
Route::post('/prioritize', 'WorkshopController@priopost')->name('priopost');


//-------END OF SECTION-----------------------------------------------------


/*
|--------------------------------------------------------------------------
|  User &roles routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/

Route::get('/myprofile', 'UserController@getMyProfile')->name('myprofile');

Route::get('/users', 'UserController@getRoles')->name('proto.protoroles');

Route::get('/createuser', 'UserController@getCreateUser')->name('createuser');

Route::get('/edituser', 'UserController@getEdituser')->name('user.edituser');
Route::post('/edituser', 'UserController@postEdituser')->name('user.postedituser');

// Set role - paramters are userid and roleid
Route::post('/setrole', 'UserController@setRole')->name('setrole');



//-------END OF SECTION-----------------------------------------------------


/*
|--------------------------------------------------------------------------
|  Drivers routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/

//route-preview
Route::get('/route-preview', 'DriverController@getRoutePreview')->name('transport.route-preview');

//route-endkm

//route-startkm
Route::get('/route-startkm', 'DriverController@getRouteStartKm') ->name('transport.route-startkm');
Route::post('/route-startkm', 'DriverController@setRouteStartKm') ->name('transport.route-setstartkm');

//Route-endKm
Route::get('/route-endkm', 'DriverController@getRouteEndKm')->name('transport.route-endkm');

Route::post('/route-endkm', 'DriverController@setRouteEndKm')->name('transport.route-setendkm');
//route-report

Route::get('/route-report', 'DriverController@getRouteReport')->name('transport.route-report');

//route-drive
Route::get('/route-drive', 'DriverController@getRouteDrive')->name('transport.route-drive');

Route::get('/optimize', 'DriverController@optimize')->name('optimize');


Route::post('/markdel', 'DriverController@markdelivered')->name('markdelivered');
Route::post('/undokdel', 'DriverController@undodelivered')->name('undodelivered');







//-------END OF SECTION-----------------------------------------------------



/*
|--------------------------------------------------------------------------
|  Other routes
|--------------------------------------------------------------------------
|
| This section contains the dashboard routes for the dashboard and
| dataexport functionality
| The given routes is used by Office and Administration
|
*/

Auth::routes();

//Force login if you are not before
Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

//search autocomplete
Route::get('/autocomplete/{session}/{query}', 'HomeController@searchGoogleAutocomplete');
//search places api
Route::get('/searchplacesapi', 'HomeController@searchplacesapi');


//-------END OF SECTION-----------------------------------------------------


Route::get('/wtest', 'HomeController@wtest');





/*
//Ordre status. Søk opp et ordrenummer og få informasjon om det.
Route::get('/orderstatus', 'HomeController@getOrderStatus')->name('orderstatus');

//Prototype kjørekontor midlertidig rute
Route::get('/prototest', 'HomeController@getPrototest')->name('proto.prototest');




Route::get('/prototest2', 'HomeController@getPrototest2')->name('proto.prototest2');

Route::get('/protohome', 'HomeController@getPrototestHome')->name('proto.prototesthome');




*/



/*

Route::get('/boot', function(){
   return view('boostraptesting');
});

//Thomas Laraveltest
Route::get('/thomas', function(){
   return view('thomas');
});




Route::get('/proto', function(){
   return view('proto');
})->name('proto');

Route::get('/drive', function(){
    return view('drive');
})->name('drive');

Route::get('/drivestart', function(){
    return view('drivestart');
})->name('drivestart');





//end Transport routes

//Roles test attaching admin role
Route::get('/attachadmin/{id}', 'HomeController@attachAdmin')->name('setadmin');

//Roles test attaching user role
Route::get('/attachuser/{id}', 'HomeController@attachUser')->name('setuser');

//Roles test attaching office role
Route::get('/attachoffice/{id}', 'HomeController@attachOffice')->name('setoffice');
*/


/*
 *  Office roles
 * */

/*
Route::get('/userroles', 'HomeController@userRoles')->name('office.userroles');

Route::get('/edituser/{id}', 'HomeController@editUser')->name('office.edituser');

Route::post('/storeedituser', 'HomeController@storeEditUser')->name('office.storeedituser');

*/
/*
 * Workshops
 * */

//Route::get('/workshops', 'HomeController@getWorkshops')->name('office.workshops');

//Route::get('/workshops/create', 'HomeController@getCreateWorkshops')->name('office.workshops.create');

//




/*
 *  Office routes
 * */

//Route::get('/routes', 'HomeController@getRoutes')->name('office.routes');

