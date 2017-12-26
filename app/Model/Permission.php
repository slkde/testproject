<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     //表名
    public $table = 'ask_permission';
    //主键
    public $primaryKey = 'id';

    //允许批量操作的字段
    public $guarded = [];

    //自动维护时间字段
    public $timestamps = false;
}
