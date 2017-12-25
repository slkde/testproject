<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public $table = 'ask_message';
    //    主键
	public $primaryKey = 'id';
	
	//不允许批量操作的字段
	public $guarded = [];

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function touser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
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
