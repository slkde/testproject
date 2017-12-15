<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Focus extends Model
{
    public $table = 'ask_focus';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
