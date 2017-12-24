<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $fillable = ['email', 'password','photo'];
    public $table = 'ask_user';
    public $primaryKey = 'id';
    protected $remember_token ='';
    // public $guarded = [];
    // public $timestamps = false;

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

    public function message()
    {
        return $this->hasMany(Message::class,'id','user_id');
    }

    public function getMessage()
    {
        return $this->hasMany(Message::class,'id','to_user_id');
    }

    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = \Hash::make($password);
        
    // }
    
    public function setCreatedAt($value)
	{
		return null;
	}

}
