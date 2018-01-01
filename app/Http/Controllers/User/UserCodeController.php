<?php

namespace App\Http\Controllers\User;
require_once app_path().'/Org/code/Code.class.php';
use App\Org\code\Code;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserCodeController extends Controller
{
    public function code()
    {
        //验证码的生成
        $code = new Code();
        return $code->make();
    }
}
