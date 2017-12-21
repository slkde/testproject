<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $table = 'ask_question';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
	
	//定义一个方法来处理获取user表中的username
	// public function user()
	// {
		 // return $this->belongsTo('App\Model\User','user_id', 'id');
	// }
}
