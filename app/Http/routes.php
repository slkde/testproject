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
Route::resource('question', 'Home\QuestionListController');
Route::resource('answer', 'Home\AnswerController');
Route::get('/user/register', 'Home\UsersController@register');
Route::post('/user/register', 'Home\UsersController@store');
Route::get('/user/login', 'Home\UsersController@login');
Route::post('/user/login', 'Home\UsersController@signin');
Route::get('/logout', 'Home\UsersController@logout');
Route::resource('/user/forget', 'User\ForgetController');
Route::get('/verify/{confirm_code}', 'Home\UsersController@checkEmail');
Route::resource('/user/photo', 'User\UsersAvatarController');
Route::resource('/user/set', 'User\UsersSetController');
Route::resource('/user/message', 'User\UsersMessageController');
Route::get('/question/like/{id}', 'Home\LikeController@like');



//后台路由

//后台登录页面路由
Route::get('admin/login','admin\LoginController@login');
//后台登录验证码路由
Route::get('/code/captcha/{tmp}', 'admin\LoginController@captcha');
//后台登录提交
Route::post('admin/dologin', 'admin\LoginController@doLogin');
//忘记密码
Route::get('forget','admin\RegisterController@forget');
//后台发送邮箱找回密码
Route::post('doforget','admin\RegisterController@doForget');
//重置密码路由
Route::get('reset', 'admin\RegisterController@reset');
//修改密码操作
Route::post('doreset','admin\RegisterController@doReset');

//后台权限
Route::get('admin/auth','admin\IndexController@auth');
//加密验证
Route::get('crypt','admin\LoginController@crypt');
//路由前缀admin， 命名空间admin\, 中间件islogin和...
Route::group(['prefix' => 'admin','namespace' => 'admin', 'middleware' => 'islogin'], function(){
    //后台首页路由
    Route::get('index', 'IndexController@index');
    //退出登录
    Route::get('logout', 'IndexController@logout');
	//修改邮箱
    //Route::get('email', 'IndexController@email');
	
    //用户模块
    Route::resource('user', 'UserController');
	//角色授权
	Route::get('user/auth/{id}', 'UserController@auth');
	Route::post('user/doauth', 'UserController@doAuth');
    //话题模块
    Route::resource('topic', 'TopicController');

    //提问模块
    Route::resource('question', 'QuestionController');
	//上传图片的路由
    Route::post('upload', 'QuestionController@upload');
	
	//提问模块
    Route::resource('answer', 'AnswerController');
	
	//角色路由
	Route::resource('role', 'RoleController');
	//角色授权
	Route::get('role/auth/{id}', 'RoleController@auth');
	Route::post('role/doauth','RoleController@doAuth');
	
	//权限路由
	Route::resource('permission', 'PermissionController');
});
