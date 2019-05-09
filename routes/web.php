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

// Route::get('/', function () {
//   return view('welcome');
// });
Route::get('/', 'PagesController@index');
Route::get('/massage', 'PagesController@massage');
Route::get('/baoyang', 'PagesController@baoyang');
Route::get('/ptmiss', 'PagesController@ptmiss');
Route::get('/help', 'PagesController@help')->name('help');
Route::resource('posts', 'PostsController');
Route::resource('misss', 'MisssController');
Route::resource('ptmisss', 'PtmisssController');
Route::resource('massages', 'MassageController');
//Route::get('/baoyangs/edit', function () {
 // return view('posts.baoyang_edit');
 // });
Route::resource('baoyangs', 'BaoyangsController');

Auth::routes();

Route::get('/initprice', 'AdminController@initprice');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/gmap', function () {
     return view('gmap');
   });
Route::get('/geo', function () {
return view('posts.geocode');
});
Route::get('/geot', function () {
  return view('posts.geocodet');
  });
Route::get('/geog', function () {
  return view('posts.geocodeg');
  });
Route::get('/createTbl', 'CreateTblController@createTbl');
/*App::bind('App\Billing\Stripe', function(){
  return new \App\Billing\Stripe(config('services.stripe.secret'));
});
**/
//$stripe=App::;
//dd(resolve('App\Billing\Stripe'));
Route::get('/dook', 'TestController@doAwesome');
Route::post('/email', 'HelpsController@email');
//Route::get('/email', 'HelpsController@email')->name('sendEmail');


Auth::routes();
Route::group(['middleware' => 'auth'], function() {
  Route::get('/help', 'PagesController@help')->name('help');
  //Route::post('/pay/{amt}', 'DashboardController@pay')->name('pay');
    Route::get('/plans', 'PlanController@index')->name('plans.index');
    Route::get('/plans/{plan}', 'PlanController@show')->name('plans.show');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');
});

//Route::get('/showcard', 'DashboardController@showcard');

Route::get('/listprice/{amt}/{period}', 'PayController@listprice');

//Route::post('/updateAmt', 'PayController@updateAmt');
//Route::post('/charge', 'PayController@charge');

Route::post('/webhook', 'PayController@webhook');
Route::get('/webhook', 'PayController@webhook');
