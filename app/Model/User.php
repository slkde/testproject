<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    public $table = 'ask_user';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

    //用户注册
    public function register($user_reg)
    {
        $this->email = $user_reg['email'];
        $this->password = $user_reg['password'];
        return $this->save() === true;
    }

}
