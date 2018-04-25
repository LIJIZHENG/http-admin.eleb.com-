<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    public function index(){
      if(Auth::user()){
          $rows=Activity::all();
          return view('activity.index',compact('rows'));
      }else{
          session()->flash('success','请登录!');
          return redirect()->route('login.create');
      }
    }
    public function create(){
        return view('activity.create');
    }
    public function store(Request $request){
        var_dump($request->contents);
//        $fileName=$request->file('file')->store('public/logo');
//        $client = App::make('aliyun-oss');
//        try{
//            $client->uploadFile(getenv('OSS_BUCKET'), $fileName, storage_path('app/'.$fileName));
//            $url=['url'=>'https://lijizheng-laravel.oss-cn-beijing.aliyuncs.com/'.$fileName];
//            return $url;
//        } catch(OssException $e) {
//            printf($e->getMessage() . "\n");
//            return;
//        }
//        $this->validate($request,[
//            'name'=>'required|min:2',
//            'contents'=>'required',
//            'start'=>'required',
//            'end'=>'required'
//        ],[
//            'name.required'=>'活动名称不能为空!',
//            'name.min'=>'活动名称不能小于2!',
//            'contents.required'=>'活动内容不能为空!',
//            'start.required'=>'活动开始时间不能为空!',
//            'end.required'=>'活动开始时间不能为空!'
//        ]);
//        if(strtotime($request->start)>=strtotime(date('Y-m-d',time())) && strtotime($request->start)<=strtotime($request->end)){
//            Activity::create(['name'=>$request->name,'contents'=>$request->contents,'start'=>$request->start,'end'=>$request->end]);
//            session()->flash('success','添加成功!');
//            return redirect()->route('activity.index');
//        }else{
//            session()->flash('success','活动开始时间不能是无效的时间!');
//            return redirect()->route('activity.create');
//        }
    }
    public function destroy(Activity $activity){
        $activity->delete();
        echo 'success';
    }
    public function edit(Activity $activity){
        return view('activity.edit',compact('activity'));
    }
    public function update(Request $request,Activity $activity){
        $this->validate($request,[
            'name'=>'required|min:2',
            'contents'=>'required',
            'start'=>'required',
            'end'=>'required'
        ],[
            'name.required'=>'活动名称不能为空!',
            'name.min'=>'活动名称不能小于2!',
            'contents.required'=>'活动内容不能为空!',
            'start.required'=>'活动开始时间不能为空!',
            'end.required'=>'活动开始时间不能为空!'
        ]);
        if(strtotime($request->start)>=strtotime(date('Y-m-d',time())) && strtotime($request->start)<=strtotime($request->end)) {
            $activity->update(['name' => $request->name, 'contents' => $request->contents, 'start' => $request->start, 'end' => $request->end]);
            session()->flash('success', '修改成功!');
            return redirect()->route('activity.index');
        }else{
            session()->flash('success','活动开始时间不能是无效的时间!');
            return redirect()->route('activity.edit',['activity'=>$activity]);
        }
    }
    public function show(Activity $activity){
         $row=Activity::find($activity->id);
         return view('activity.show',compact('row'));
    }
}
