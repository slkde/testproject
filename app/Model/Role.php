<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //表名
    public $table = 'ask_role';
    //主键
    public $primaryKey = 'id';

    //允许批量操作的字段
    public $guarded = [];

    //自动维护时间字段
    public $timestamps = false;
	
	//找到关联的权限模型
    public function permissions()
    {
        //多对多模型
//        参数一：关联模型
//        参数二：关联表
//        参数三：当前模型在关联表中的外键
//        参数四：关联模型在关联表中的外键
        return $this->belongsToMany('App\Model\Permission','ask_role_permission', 'role_id', 'permission_id');
    }
}
