<?php

namespace App\Http\Controllers;

use App\Goodsclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsclassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    //显示商品分类列表
    public function index(){
        $rows=Goodsclass::all();
        return view('goodsclass.index',compact('rows'));
    }
    //显示商品添加页面
    public function create(){
        return view('goodsclass.create');
    }
    //处理商品添加数据
    public function store(Request $request){
        $this->validate($request,[
            'goods_class_name'=>'required|min:2',
            'goods_class_logo'=>'required|image',
            'captcha'=>'required|captcha'
        ],[
            'goods_class_name.required'=>'商品名称不能为空!',
            'goods_class_name.min'=>'商品名称不能小于2!',
            'goods_class_logo.required'=>'商品图片不能为空!',
            'goods_class_logo.image'=>'商品图片错误!',
            'captcha.required'=>'验证码不能为空!',
            'captcha.captcha'=>'验证码不正确!'
        ]);
        $fileName=$request->file('goods_class_logo')->store('public/logo');
        Goodsclass::create([
            'goods_class_name'=>$request->goods_class_name,
            'goods_class_logo'=>$fileName
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('goodsclass.index');
    }
    //删除商品数据
    public function destroy(Goodsclass $goodsclass){
        $goodsclass->delete();
        echo 'success';
    }
    //显示修改页面
    public function edit(Goodsclass $goodsclass){
        return view('goodsclass.edit',compact('goodsclass'));
    }
    //处理修改数据
    public function update(Request $request,Goodsclass $goodsclass){
        $this->validate($request,[
            'goods_class_name'=>'required|min:2',
            'captcha'=>'required|captcha'
        ],[
            'goods_class_name.required'=>'商品名称不能为空!',
            'goods_class_name.min'=>'商品名称不能小于2!',
            'captcha.required'=>'验证码不能为空!',
            'captcha.captcha'=>'验证码不正确!'
        ]);
        if($request->goods_class_logo){
            $fileName=$request->file('goods_class_logo')->store('public/logo');
            $goodsclass->update([
                'goods_class_name'=>$request->goods_class_name,
                'goods_class_logo'=>$fileName
            ]);
        }else{
            $goodsclass->update([
                'goods_class_name'=>$request->goods_class_name,
            ]);
        }
        session()->flash('success','修改成功!');
        return redirect()->route('goodsclass.index');
    }
}
