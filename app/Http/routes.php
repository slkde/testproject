<?php










































































































































































































































































































//后台路由
Route::get('/', function () {
    return view('welcome');//欢迎页面
});
//后台登录页面路由
Route::get('admin/login','admin\LoginController@login');
//后台登录验证码路由
Route::get('/code/captcha/{tmp}', 'admin\LoginController@captcha');
//后台登录提交
Route::post('admin/dologin', 'admin\LoginController@doLogin');
//加密验证
//Route::get('crypt','admin\LoginController@crypt');
//路由前缀admin， 命名空间admin\, 中间件islogin
Route::group(['prefix' => 'admin','namespace' => 'admin', 'middleware' => 'islogin'], function(){
    //后台首页路由
    Route::get('index', 'IndexController@index');
    //退出登录
    Route::get('logout', 'IndexController@logout');
    //用户模块
    Route::resource('user', 'UserController');
});



















