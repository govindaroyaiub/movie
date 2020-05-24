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

Route::get('/land', 'PagesController@landing');

Route::get('/', 'DataController@index');
Route::get('/api/shows', 'DataController@showsApi');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload', 'HomeController@upload');

Route::get('/cs', function() {
  return view('coming_soon');
});

Route::get('/{locale}', function($locale)
{
  Session::put('locale', $locale);
  return redirect()->back();
});
