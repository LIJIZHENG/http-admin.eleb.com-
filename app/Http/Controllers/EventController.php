<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function index(){
        $rows=Event::all();
        $time=time();
        return view('event.index',compact('rows','time'));
    }

    public function create(){
        return view('event.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required'
        ],[

        ]);
        Event::create(['title'=>$request->title,'content'=>$request->content,'signup_start'=>strtotime($request->signup_start),'signup_end'=>strtotime($request->signup_end),'prize_date'=>strtotime($request->prize_date),'signup_num'=>$request->signup_num,'is_prize'=>$request->is_prize]);
        session()->flash('success','添加成功!');
        return redirect()->route('event.index');
    }

    public function show(Event $event){
        return view('event.show',compact('event'));
    }

    public function edit(Event $event){
       return view('event.edit',compact('event'));
    }

    public function update(Event $event,Request $request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required'
        ],[

        ]);
        $event->update(['title'=>$request->title,'content'=>$request->content,'signup_start'=>$request->signup_start,'signup_end'=>$request->signup_end,'prize_date'=>$request->prize_date,'signup_num'=>$request->signup_num,'is_prize'=>$request->is_prize]);
        session()->flash('success','修改!');
        return redirect()->route('event.index');
    }

    public function destroy(Event $event){
        $event->delete();
        echo 'success';
    }

    public function start(Request $request){
        $users = DB::table('event_members')->where('events_id', '=',$request->id)->first();
        $u = DB::table('events')->where('id', '=',$request->id)->first();
        if($u->is_prize){
            session()->flash('success','已开过奖不能再开!');
        }else{
            if($users){
                DB::table('events')
                    ->where('id','=',$request->id)
                    ->update(['is_prize' => 1]);
                $enevt_prizes = DB::table('enevt_prizes')->where('events_id', '=',$request->id)->get();
                $events_id=[];
                foreach ($enevt_prizes as $enevt_prize){
                    $events_id[]=$enevt_prize->id;
                }
                $event_members = DB::table('event_members')->where('events_id', '=',$request->id)->get();
                $member_id=[];
                foreach ($event_members as $event_member){
                    $member_id[]=$event_member->member_id;
                    $a=mt_rand(0,count($events_id)-1);
                    $b=mt_rand(0,count($member_id)-1);
                    $events_num=$events_id[$a];
                    $member_num=$member_id[$b];
                    DB::table('results')->insert(['events_id' =>$events_num, 'member_id' =>$member_num]);
                }
                session()->flash('success','开奖成功!');
            }else{
                session()->flash('success','没有商户报名活动不能开奖!');
            }
        }

        return redirect()->route('event.index');
    }

    public function lottery(){
        $rows=DB::table('results')->select('id','events_id','member_id')->get();;
        $b=[];
        foreach ($rows as $row){
            $goodsaccounts=DB::table('goodsaccounts')->where('id', '=',$row->member_id)->first();
            $enevt_prizes=DB::table('enevt_prizes')->where('id', '=',$row->events_id)->first();
            $enevts=DB::table('events')->where('id', '=',$enevt_prizes->events_id)->first();
            $enevt_prizes->enevts=$enevts;
            $enevt_prizes->goodsaccounts=$goodsaccounts;
            $b[]=$enevt_prizes;
        }
        return view('event.lottery',compact('b'));
    }

    public function apply(Request $request){
        $apply = DB::table('event_members')
            ->join('goodsaccounts', 'event_members.member_id', '=', 'goodsaccounts.id')
            ->join('events', 'events.id', '=', 'event_members.events_id')
            ->where('events_id','=',$request->id)
            ->select('goodsaccounts.name','events.title')
            ->get();

       return view('event.apply',compact('apply'));
    }
}
