<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //表名
    protected $table = 'ask_user';
//    主键
    protected $primaryKey = 'id';
    //不允许批量操作的字段
    protected $guarded = [];

    //自动维护时间字段
    public $timestamps = false;
}
