<?php



Route::get('/', 'Home\HomeController@index');
Route::resource('login', 'Home\UserLoginController');
Route::resource('reg', 'Home\UserRegController');

Route::group(['prefix'=>'user'], function(){
    Route::get('center', 'Home\User\UserCenterController@index');
    Route::resource('set', 'Home\User\CenterSetController');
    Route::get('message', 'Home\User\UserMessageController@index');
    Route::get('home', 'Home\User\UserHomeController@index');
});








































































































































































































































































































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
Route::get('crypt','admin\LoginController@crypt');
//路由前缀admin， 命名空间admin\, 中间件islogin
Route::group(['prefix' => 'admin','namespace' => 'admin', 'middleware' => 'islogin'], function(){
    //后台首页路由
    Route::get('index', 'IndexController@index');
    //退出登录
    Route::get('logout', 'IndexController@logout');
    //用户模块
    Route::resource('user', 'UserController');
    //话题模块
    Route::resource('topic', 'TopicController');

    //提问模块
    Route::resource('question', 'QuestionController');
	//上传图片的路由
    Route::post('upload', 'QuestionController@upload');
});





















