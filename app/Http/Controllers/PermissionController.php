<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    //显示权限列表
    public function index(){
        $rows=Permission::all();
        return view('permission.index',compact('rows'));
    }
    public function create(){
        return view('permission.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[]);
        $createPost = new Permission();
        $createPost->name         =$request->name;
        $createPost->display_name =$request->display_name; // optional
// Allow a user to...
        $createPost->description  =$request->description; // optional
        $createPost->save();
        session()->flash('success','添加权限成功!');
        return redirect()->route('permission.index');
    }
    public function edit(Permission $permission){
       return view('permission.edit',compact('permission'));
    }
    public function update(Request $request,Permission $permission){
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[]);
        $permission->update(['name'=>$request->name,'display_name'=>$request->display_name,'description'=>$request->description]);
        session()->flash('success','修改成功!');
        return redirect()->route('permission.index');
    }
    public function destroy(Permission $permission){
       $row=DB::table('permission_role')->where('permission_id','=',$permission->id)->first();
       if($row){
           session()->flash('success','该权限下面有角色不能删除!');
           return redirect()->route('permission.index');
       }else{
           $permission->delete();
           echo 'success';
       }
    }
}
