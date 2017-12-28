<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


use App\Model\Message;
use App\Model\Question;
use App\Model\Answer;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['username','nickname','sex','identty','email', 'password','photo'];
    public $table = 'ask_user';
    public $primaryKey = 'id';
    public $remember_token ='';
    public $guarded = [];
    public $timestamps = false;

    //用户注册
    public function register($user_reg)
    {
        $this->email = $user_reg['email'];
        $this->password = $user_reg['password'];
        return $this->save() === true;
    }

    public function question()
    {
        return $this->hasMany(Question::class,'id','user_id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,'id','user_id');
    }

    public function roles()
    {
        //多对多模型
//        参数一：关联模型
//        参数二：关联表
//        参数三：当前模型在关联表中的外键
//        参数四：关联模型在关联表中的外键
        return $this->belongsToMany('App\Model\Role','ask_user_role', 'user_id', 'role_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class,'id','user_id');
    }

    
    public function getMessage()
    {
        return $this->hasMany(Message::class,'id','to_user_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
        
    }
    
    public function setCreatedAt($value)
	{
		return null;
	}
}
