<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    public $table = 'ask_user';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
	
	//定义一个方法来处理获取user表中的username
	public function user()
	{
		 return $this->hasMany('App\Model\Question','user_id', 'id');
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
}
