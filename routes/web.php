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

Auth::routes();


Route::get('/home', 'PageController@home')->name('home');

Route::get('/jooble', 'PageController@jooble')->name('jooble');

Route::get('/rss', 'PageController@rss')->name('rss');


Route::post('/joobleAPI', 'JoobleApiController@getListings')->middleware('auth');

Route::post('/getRSS', 'RSSfeedController@getListings')->middleware('auth');


Route::resource('listings', 'ListingController')->middleware('auth');


Auth::routes();



