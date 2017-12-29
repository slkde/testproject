<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $table = 'ask_topic';
    public $primaryKey = 'id';
    public $guarded = [];
	public $timestamps = false;
   
   
}
