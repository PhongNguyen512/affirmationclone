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
    
Route::get('/admin', function(){
    return view('admin/index');
})->name('admin.index')->middleware('auth');

Route::group(['prefix' => 'categories', 'middleware' => ['auth']], function(){
    Route::get('/', 'CategoriesController@index')->name('categories.index');
    
    Route::get('/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/', 'CategoriesController@store')->name('categories.store');
    Route::get('/{category}', 'CategoriesController@show')->name('categories.show');

    Route::get('/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::patch('/{category}', 'CategoriesController@update')->name('categories.update');
    Route::delete('/{category}', 'CategoriesController@destroy')->name('categories.destroy');
});

Route::group(['prefix' => 'items', 'middleware' => ['auth']], function(){ 
    Route::get('/', 'ItemController@index')->name('items.index');
    Route::get('/create', 'ItemController@create')->name('items.create');
    
    Route::post('/', 'ItemController@store')->name('items.store');
    Route::get('/{item}', 'ItemController@show')->name('items.show');
    Route::get('/{item}/edit', 'ItemController@edit')->name('items.edit');
    Route::patch('/{item}', 'ItemController@update')->name('items.update');
    Route::delete('/{item}', 'ItemController@destroy')->name('items.destroy');
});

Auth::routes(['register' => false]);
