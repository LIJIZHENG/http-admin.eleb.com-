<?php

namespace App\Http\Controllers;

use App\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    public function index(){
        if(Auth::user()){
            $rows=Admins::all();
            return view('admins.index',compact('rows'));
        }else{
            session()->flash('success','请登录!');
            return redirect()->route('login.create');
        }
    }
    public function create(){
        return view('admins.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'email'=>'required|email',
            'password'=>'required'
        ],[
           'name.required'=>'用户名不能为空!',
            'name.min'=>'长度必须大于2!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式不正确!',
            'password.required'=>'密码不能为空!'
        ]);
        Admins::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('admins.index');
    }
    public function destroy(Admins $admin){
        $admin->delete();
        echo 'success';
    }
    public function edit(Admins $admin){
         return view('admins.edit',compact('admin'));
    }
    public function update(Request $request,Admins $admin){
        $this->validate($request,[
            'name'=>'required|min:2',
            'email'=>'required|email',
        ],[
            'name.required'=>'用户名不能为空!',
            'name.min'=>'长度必须大于2!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式不正确!',
        ]);
        $admin->update(['name'=>$request->name,
            'email'=>$request->email]);
        session()->flash('success','修改成功!');
        return redirect()->route('admins.index');
    }
    //修改密码
    public function revise(Request $request){
        if($request->isMethod('post')){
            $this->validate($request,[
                'newPwd'=>'required|confirmed',
            ],[]);
                if(!Hash::check($request->password,Auth::user()->password)){
                session()->flash('success','旧密码不正确!');
                return redirect()->route('login.create');
            }else{
               $newPwd=bcrypt($request->newPwd);
               $id=Auth::user()->id;
//               var_dump($id);die;
                DB::update("update admins set password='{$newPwd}' where id={$id}");
                Auth::logout();
                session()->flash('success','修改密码成功!');
                return redirect()->route('login.create');
            }
        }else{
            return view('admins.revise');
        }
    }
}
