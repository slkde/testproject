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





















