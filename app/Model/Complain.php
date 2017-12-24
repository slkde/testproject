<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public $table = 'ask_complain';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
