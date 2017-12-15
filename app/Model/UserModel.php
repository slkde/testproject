<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $table = 'ask_user';

    public $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = false;
}
