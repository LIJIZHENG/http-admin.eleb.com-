<?php

namespace App\Http\Controllers;

use App\EnevtPrize;
use App\Event;
use Illuminate\Http\Request;

class EnevtPrizeController extends Controller
{
    //
    public function index(){
      $rows=EnevtPrize::all();
      return view('enevt_prize.index',compact('rows'));
    }

    public function create(Request $request){
//        $rows=Event::all();
      $id=$request->id;
        return view('enevt_prize.create',compact('rows','id'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[

        ]);
        EnevtPrize::create(['name'=>$request->name,'events_id'=>$request->events_id,'description'=>$request->description]);
        session()->flash('success','添加成功!');
        return redirect()->route('enevt_prize.index');
    }

    public function edit(EnevtPrize $enevt_prize){
        $rows=Event::all();
        return view('enevt_prize.edit',compact('rows','enevt_prize'));
    }

    public function update(EnevtPrize $enevt_prize,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[

        ]);
        $enevt_prize->update(['name'=>$request->name,'events_id'=>$request->events_id,'description'=>$request->description]);
        session()->flash('success','修改成功!');
        return redirect()->route('enevt_prize.index');
    }

    public function destroy(EnevtPrize $enevt_prize){
        $enevt_prize->delete();
        echo 'success';
    }
}
