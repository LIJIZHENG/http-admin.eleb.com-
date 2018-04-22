<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodsaccount extends Model
{
    protected $fillable = [
        'name', 'email', 'password','logo','is_by','goods_class_id','goodsnews_id'
    ];
    public function goodsclass(){
      return  $this->belongsTo(Goodsclass::class,'goods_class_id','id');
    }
}
