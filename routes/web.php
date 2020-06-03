<?php

use Illuminate\Support\Facades\Route;

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


Route::get('map', function() {
   return view('map');
});

Route::get('/', 'DataController@index');
Route::get('/en', 'DataController@english_landing');
Route::get('/api/shows', 'DataController@showsApi');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function()
{
  Route::post('/upload', 'HomeController@upload');
  Route::get('/test-en', 'PagesController@landing_en');
  Route::get('/test-nl', 'PagesController@landing_nl');
  Route::post('/update-info', 'HomeController@update_info')->name('update_info');
});
