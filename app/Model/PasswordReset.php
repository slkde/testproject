<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    //
    protected $fillable = ['email','token'];

    public function setUpdatedAt($value)
    {
        return null;
    }
}
