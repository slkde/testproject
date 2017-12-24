<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	//表名
	public $table = 'ask_question';
//    主键
	public $primaryKey = 'id';
	
	//不允许批量操作的字段
	public $guarded = [];
//	允许修改的字段
//	public $fillable = [];
	
	//自动维护时间字段
//	public $timestamps = true;

	public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    } 
	
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
	}
	
	public function question_answer()
	{
		return $this->hasMany(Answer::class, 'question_id', 'id');
	}

	
	public function setUpdatedAt($value)
	{
		return null;
	}

	public function getUpdatedAtColumn()
    {
        return null;
    }
}
