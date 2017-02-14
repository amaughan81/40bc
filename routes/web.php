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

Route::get('/', 'HomeController@index');
Route::get('/home', function () {
    return redirect('/bars');
});

Auth::routes();

Route::resource('/bars', 'BarsController');
Route::resource('/challenges', 'ChallengesController');
Route::get('/progress/{bar_id}', 'ProgressController@set');
Route::get('/map', 'MapController@index');
Route::get('/map/bar/{bar}', 'MapController@bar');
