<?php

namespace App\Http\Controllers\admin;

use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//验证码的use
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
//验证的use
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Session;
class LoginController extends Controller
{
    //后台登录页面
    public function login()
    {
        return view('admin.login');
    }
    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }
    //处理登录逻辑
    public function doLogin(Request $request)
    {
        //1.获取用户提交的数据
        $input = $request->except('_token');
//        dd($input);
        //2.做数据的表单验证
        $rule = [
            'username' => 'required|between:4,18|alpha_dash',
            'password' => 'required|between:4,18'
        ];
        $mess = [
            'username.required' => '用户名不能为空',
            'username.between' => '用户名必须在4-18位之间',
            'username.alpha_dash' => '用户名只能由数字、字母或下划线组成',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        //3.验证码是否正确
        if ($input['code'] != session('code')){
            return redirect('admin/login')->with('errors', '验证码错误');
        }
        //4.判断是否有此用户
        $user = User::where('username', $input['username'])->first();
        if (empty($user)){
            return redirect('admin/login')->with('errors', '此用户不存在');
        }

//        dd($user->password);?????
        //5.判断密码是否正确
    //     if (Crypt::decrypt($user->password != $input['password']){
    //         return redirect('admin/login')->with('errors', '密码错误');
    //    }

       if(\Auth::attempt([
            'username' => $input['username'],
            'password' => $input['password'],
        ])){
            //6.将当前登录用户的数据存入session中
            session(['user' => $user]);
            
            //7.登陆成功后就跳转到后台首页，失败就跳转回登录页
            return redirect('admin/index');
        }
        return redirect('admin/index')->with('errors', '密码错误');

    }

    public function crypt()
    {
      $str = 1234;
       $res = Crypt::encrypt($str);
	   dd($res);
        return $res;
        $str = 'eyJpdiI6IlhBVEMxMWhcLzhFa2FVc21LV2l3NXhBPT0iLCJ2YWx1ZSI6Ikt1dzhDQ1JzVVJEUkdFNGhjM2tEYWc9PSIsIm1hYyI6IjVmZmM0MGIwZmYzYmRiYmU5ZjE5OWU2NjU4Yjk5OTU5Nzk2MTRmYjEzN2U1YzAxYjAwZDc0ZWQ3Y2JlYWJkMDQifQ==';
        $res = Crypt::decrypt($str);
        return $res;
    }

}
