<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	public $table = 'ask_answer';
//    主键
	public $primaryKey = 'id';
	
	//不允许批量操作的字段
	public $guarded = [];
//	允许修改的字段
//	public $fillable = [];
	
	//自动维护时间字段
//	public $timestamps = true;


	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
	public function answer_question()
	{
		return $this->belongsTo('App\Model\Question', 'question_id', 'id');
	}
	
	public function setUpdatedAt($value)
	{
		return null;
	}
}
