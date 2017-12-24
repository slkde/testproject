<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $table = 'ask_config';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
