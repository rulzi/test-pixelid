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

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account', 'uses' => 'UserController@index']);
        Route::put('/email/{id}', ['as' => 'emailupdate', 'uses' => 'UserController@update_email']);
        Route::put('/password/{id}', ['as' => 'passwordupdate', 'uses' => 'UserController@update_password']);
    });
    Route::post('/tweet', ['as' => 'tweet', 'uses' => 'TweetController@save']);
});
