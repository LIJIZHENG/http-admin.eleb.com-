<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //显示登录页面
    public function create(){
        return view('login.login');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'用户名不能为空!',
            'name.min'=>'用户名不能小于2!',
            'password.required'=>'密码不能为空!',
            'captcha.required'=>'验证码不能为空!',
            'captcha.captcha'=>'验证码不正确!'
        ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            session()->flash('success','登录成功!');
            return redirect()->route('goodsaccount.index');
        }else{
            session()->flash('success','登录失败!');
            return redirect()->route('login.create');
        }
    }
    public function destroy(){
        Auth::logout();
        session()->flash('success','退出成功!');
        return redirect()->route('login.create');
    }
}
