<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function email($name,$email){
        Mail::send(
            'mail',//邮件视图模板
            $a=$email,
            ['name'=>$name],
            function ($message,$a){
                $message->to($a)->subject('订单确认');
            }
        );
        return '邮件发送成功';
    }
}
