<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $table = 'ask_question';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
