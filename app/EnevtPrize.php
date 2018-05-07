<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnevtPrize extends Model
{
    //
    protected $fillable = [
        'name', 'events_id', 'description','member_id'
    ];

    public function events(){
        return $this->belongsTo(Event::class,'events_id','id');
    }
}
