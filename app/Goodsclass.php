<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodsclass extends Model
{
    //
    protected $fillable = [
        'goods_class_name', 'goods_class_logo'
    ];
}
