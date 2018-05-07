<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    //
    public function events(){
        return $this->belongsTo(Event::class,'events_id','id');
    }
    public function goodsaccounts(){
        return $this->belongsTo(Goodsaccount::class,'member_id','id');
    }
}
