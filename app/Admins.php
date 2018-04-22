<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admins extends Authenticatable
{
    //
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
