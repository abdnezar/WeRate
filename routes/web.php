<?php

use Illuminate\Support\Facades\Route;

# Genres Operations
Route::get('genre/create', 'App\Http\Controllers\Dashboard\GenresController@create');
Route::post('genre/store', 'App\Http\Controllers\Dashboard\GenresController@store');
Route::post('genre/delete/{id}', 'App\Http\Controllers\Dashboard\GenresController@drop');
Route::post('genre/restore/{id}', 'App\Http\Controllers\Dashboard\GenresController@restore');
Route::get('genre/update', 'App\Http\Controllers\Dashboard\GenresController@getUpdateView');
Route::post('genre/update/{id}', 'App\Http\Controllers\Dashboard\GenresController@update');

# Stores Operations
Route::get('/', 'App\Http\Controllers\Dashboard\StoresController@index');
Route::get('store/create', 'App\Http\Controllers\Dashboard\StoresController@create');
Route::post('store/store', 'App\Http\Controllers\Dashboard\StoresController@store');
Route::get('store/manage', 'App\Http\Controllers\Dashboard\StoresController@getManageView');
Route::post('store/delete/{id}', 'App\Http\Controllers\Dashboard\StoresController@drop');
Route::post('store/restore/{id}', 'App\Http\Controllers\Dashboard\StoresController@restore');
Route::post('store/update/{id}', 'App\Http\Controllers\Dashboard\StoresController@update');

# Public Page
Route::get('stores', 'App\Http\Controllers\Public\StoresController@index');
Route::get('store/info/{id}', 'App\Http\Controllers\Public\StoresController@getStoreInfo');
Route::post('store/addRate/{storeId}/{userMac}', 'App\Http\Controllers\Public\StoresController@addRate');
Route::get('search', 'App\Http\Controllers\Public\StoresController@search');
