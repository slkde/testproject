<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $table = 'ask_answer';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
