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


Route::get('/','App\Http\Controllers\Ka2Controller@index')->name('home');
Route::get('/reIndex','App\Http\Controllers\Ka2Controller@reIndex');

Route::get('/login','App\Http\Controllers\Ka2Controller@login');
Route::post('/login','App\Http\Controllers\Ka2Controller@postLogin');

Route::get('/logout','App\Http\Controllers\Ka2Controller@logout');

Route::get('/new','App\Http\Controllers\Ka2Controller@new');
Route::post('/new','App\Http\Controllers\Ka2Controller@postNew');

Route::get('/update','App\Http\Controllers\Ka2Controller@update');
Route::post('/update','App\Http\Controllers\Ka2Controller@postUpdate');

Route::get('/user_data','App\Http\Controllers\Ka2Controller@user_data');

Route::post('/search','App\Http\Controllers\Ka2Controller@search');

Route::get('/detail','App\Http\Controllers\Ka2Controller@detail');

Route::post('/put','App\Http\Controllers\Ka2Controller@put');

Route::get('/history','App\Http\Controllers\Ka2Controller@history');

Route::get('/recommend','App\Http\Controllers\Ka2Controller@recommend');

Route::get('/recommended','App\Http\Controllers\Ka2Controller@recommended');

Route::get('/good','App\Http\Controllers\Ka2Controller@good');

Route::get('/good_off','App\Http\Controllers\Ka2Controller@good_off');

Route::get('/recommend_off','App\Http\Controllers\Ka2Controller@recommend_off');

Route::get('/del','App\Http\Controllers\Ka2Controller@del');

Route::get('/delete','App\Http\Controllers\Ka2Controller@delete');

Route::get('/come_del','App\Http\Controllers\Ka2Controller@come_del');

Route::get('/like/{id}/{index}','App\Http\Controllers\Ka2Controller@like');
Route::get('/favorite/{id}/{index}','App\Http\Controllers\Ka2Controller@favorite');

Route::get('/history_put/{id}','App\Http\Controllers\Ka2Controller@history_put');

