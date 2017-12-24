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

Route::get('/', function () {
    return view('home.home');
});
Route::resource('answer', 'Home\AnswerController');


Route::resource('question', 'Home\QuestionListController');
Route::get('/user/register', 'Home\UsersController@register');
Route::post('/user/register', 'Home\UsersController@store');
Route::get('/user/login', 'Home\UsersController@login');
Route::post('/user/login', 'Home\UsersController@signin');
Route::get('/logout', 'Home\UsersController@logout');
Route::get('/verify/{confirm_code}', 'Home\UsersController@checkEmail');
Route::resource('/user/photo', 'User\UsersAvatarController');
Route::resource('/user/message', 'User\UsersMessageController');