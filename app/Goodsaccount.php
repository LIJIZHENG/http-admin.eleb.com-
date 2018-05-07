<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Goodsaccount extends Model
{
    protected $fillable = [
        'name', 'email', 'password','logo','is_by','goods_class_id','goodsnews_id'
    ];
    public function goodsclass(){
      return  $this->belongsTo(Goodsclass::class,'goods_class_id','id');
    }
    public static function email($name,$email){
        Mail::send(
            'mail',//邮件视图模板
            ['name'=>$name],
            function ($message)use($email){
                $message->to($email)->subject('订单确认');
            }
        );
        return '邮件发送成功';
    }
}
