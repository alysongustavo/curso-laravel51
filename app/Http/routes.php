<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'StoreController@index');

Route::group(['prefix' => 'admin', 'where' => ['id' => '[0-9]+']], function () {

    Route::group(['prefix' => 'categories'], function () {

        Route::get('', ['as' => 'categories', 'uses' => 'CategoryController@index']);
        Route::post('', ['as' => 'categories.store', 'uses' => 'CategoryController@store']);
        Route::get('create', ['as' => 'categories.create', 'uses' => 'CategoryController@create']);
        Route::get('{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoryController@edit']);
        Route::put('{id}/update', ['as' => 'categories.update', 'uses' => 'CategoryController@update']);
        Route::get('{id}/destroy', ['as' => 'categories.destroy', 'uses' => 'CategoryController@destroy']);

    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('', ['as' => 'products', 'uses' => 'ProductsController@index']);
        Route::post('', ['as' => 'products.store', 'uses' => 'ProductsController@store']);
        Route::get('create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
        Route::get('{id}/edit', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
        Route::put('{id}/update', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
        Route::get('{id}/destroy', ['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);


        Route::get('{id}/images', ['as' => 'products.images', 'uses' => 'ProductsController@images']);
        Route::get('{id}/images/create', ['as' => 'products.images.create', 'uses' => 'ProductsController@createImages']);
        Route::post('{id}/images/store', ['as' => 'products.images.store', 'uses' => 'ProductsController@storeImages']);
        Route::get('{id}/images/destroy', ['as' => 'products.images.destroy', 'uses' => 'ProductsController@destroyImages']);
    });

});