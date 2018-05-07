<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    public function index(){
        $rows=Role::all();
        return view('role.index',compact('rows'));
    }
    public function create(){
        $rows=Permission::all();
        return view('role.create',compact('rows'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[]);
        $owner = new Role();
        $owner->name         = $request->name;
        $owner->display_name =$request->display_name; // optional
        $owner->description  = $request->description; // optional
        $owner->save();
        $owner->attachPermissions($request->permission);
        session()->flash('success','添加角色成功!');
        return redirect()->route('role.index');
    }
    public function edit(Role $role){
        $a=[];
        foreach($role->permissions()->get() as $p){
            $a[]=$p->id;
        }
        $rows=Permission::all();
        return view('role.edit',compact('role','rows','a'));
    }
    public function update(Request $request,Role $role){
//        dd($request->permission);
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[]);
        $role->update(['name'=>$request->name,'display_name'=>$request->display_name,'description'=>$request->description]);
        $role->syncPermissions($request->permission);
        session()->flash('success','修改角色成功!');
        return redirect()->route('role.index');
    }
    public function destroy(Role $role){
        $role->detachPermission($role);
        $role->delete();
        echo 'success';
    }
}
