<?php

namespace App\Http\Controllers;

use App\Regist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistController extends Controller
{
    //
   public function index(){
       $rows=DB::table('regists')->select('id','username','tel','password','status')->get();
       return view('regist.index',compact('rows'));
   }
   public function show(Regist $regist){
//       dd($regist->id);
      DB::select("update regists set status=1 WHERE id=?",[$regist->id]);
       session()->flash('success','禁用成功!');
       return redirect()->route('regist.index');
   }
    public function edit(Regist $regist){
        DB::select("update regists set status=0 WHERE id=?",[$regist->id]);
        session()->flash('success','恢复成功!');
        return redirect()->route('regist.index');
    }
}
