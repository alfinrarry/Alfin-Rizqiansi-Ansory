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
    return ('welcome');
});

Route::resource('kategori', 'CategoryController');

Route::get('layouts',function(){
    return view('layouts.master');
});  
Route::get('dashboard',function(){
    return view('dashboard.index');
});  
Route::get('layouts',function(){
    return view('dashboard');
}); 

Route::resource('kategori', 'CategoryController');

Route::get('search', 'CategoryController@search');

Route::get('/kategori/create','CategoryController@create');

Route::post('/kategori/store','CategoryController@store');

Route::get('/kategori/edit/{id}','CategoryController@edit');

Route::post('/kategori/update','CategoryController@update');

Route::get('/kategori/delete/{id}','CategoryController@delete');





