<?php

namespace App\Http\Controllers;

use App\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    //
    public function index(){
        $rows=EventMember::all();
        return view('event_member.index',compact('rows'));
    }
}
