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

Route::get('/', 'Home\HomeController@index');
Route::resource('login', 'Home\UserLoginController');
Route::resource('reg', 'Home\UserRegController');

Route::group(['prefix'=>'user'], function(){
    Route::get('center', 'Home\User\UserCenterController@index');
    Route::get('set', 'Home\User\UserSetController@index');
    Route::get('message', 'Home\User\UserMessageController@index');
    Route::get('home', 'Home\User\UserHomeController@index');
});