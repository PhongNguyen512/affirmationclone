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
})->name('home');
    
Route::get('/admin', function(){
    return view('admin/index');
})->name('admin.index')->middleware('auth');

Route::group(['prefix' => 'categories', 'middleware' => ['auth']], function(){
    Route::get('/', 'CategoriesController@index')->name('categories.index');
    
    Route::get('/{category}', 'CategoriesController@show')->name('categories.show');
});

Route::group(['prefix' => 'affirmations', 'middleware' => ['auth']], function(){ 
    Route::get('/', 'AffirmationController@index')->name('affirmations.index');

    Route::get('/{aff}', 'AffirmationController@show')->name('affirmations.show');
});

Route::group(['prefix' => 'getApi', 'middleware' => ['auth']], function(){ 
    Route::get('/', 'GetDataApiController@index')->name('getApi.index');
    
    Route::post('/', 'GetDataApiController@get')->name('getApi.get');

    Route::get('/show', 'GetDataApiController@show')->name('getApi.show');

    Route::post('/file', 'GetDataApiController@JsonFile')->name('getApi.jsonfile');
});

Auth::routes(['register' => false]);
