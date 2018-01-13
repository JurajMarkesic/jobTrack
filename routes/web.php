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


Route::get('/', 'PageController@landing');

Auth::routes();


Route::get('/home', 'PageController@home')->name('home')->middleware('auth');

Route::get('/dashboard', 'PageController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/jooble', 'PageController@jooble')->name('jooble')->middleware('auth');

Route::get('/rss', 'PageController@rss')->name('rss')->middleware('auth');

Route::post('/listings/check', 'ListingController@check')->middleware('auth');


Route::post('/joobleAPI', 'JoobleApiController@getListings')->middleware('auth');

Route::post('/getRSS', 'RSSfeedController@getListings')->middleware('auth');


Route::resource('listings', 'ListingController')->middleware('auth');


Auth::routes();



