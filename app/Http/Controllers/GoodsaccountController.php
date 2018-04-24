<?php

namespace App\Http\Controllers;

use App\Goodsaccount;
use App\Goodsclass;
use App\Goodsnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GoodsaccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    //显示商家管理列表
    public function index(Request $request){
        if(Auth::user()){
            $query=$request->query();
            $rows=Goodsaccount::where('name','like',"%{$request->name}%")->paginate(3);
            return view('goodsaccount.index',compact('rows','query'));
        }else{
            session()->flash('success','请登录!');
            return redirect()->route('login.create');
        }
    }
    //显示添加商家
    public function create(){
        $rows=Goodsclass::all();
        return view('goodsaccount.create',compact('rows'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required',
            'email'=>'required|email|unique:goodsaccounts',
            'logo'=>'required',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'estimate_time'=>'required',
        ],[
            'name.required'=>'商家名称不能为空!',
            'name.min'=>'商家名称不能大于2!',
            'password'=>'密码不能为空!',
            'email.required'=>'邮箱不能为空!',
            'email.unique'=>'邮箱必需唯一!',
            'email.email'=>'邮箱格式不对!',
            'logo.required'=>'图片不能为空!',
            'brand.required'=>'品牌不能为空!',
            'on_time.required'=>'准时送达不能为空!',
            'fengniao.required'=>'是否蜂鸟配送不能为空!',
            'bao.required'=>'是否保标记不能为空!',
            'piao.required'=>'是否票标记不能为空!',
            'zhun.required'=>'是否准标记不能为空!',
            'start_send.required'=>'起送金额不能为空!',
            'send_cost.required'=>'配送费不能为空!',
            'estimate_time.required'=>'预计时间不能为空!',
        ]);
        DB::transaction(function ()use($request) {
//            $fileName = $request->file('logo')->store('public/logo');
//            $client = App::make('aliyun-oss');
//            try{
//                $client->uploadFile(getenv('OSS_BUCKET'), $fileName,storage_path('app/'.$fileName));
//            } catch(OssException $e) {
//                printf($e->getMessage() . "\n");
//                return;
//            }
            $add=Goodsnews::create([
                'shop_name' => $request->name,
                'shop_img' =>$request->logo,
                'brand'=> $request->brand,
                'on_time' => $request->on_time,
                'fengniao' => $request->fengniao,
                'bao' => $request->bao,
                'piao' => $request->piao,
                'zhun' => $request->zhun,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'estimate_time' => $request->estimate_time,
                'notice' => $request->notice,
                'discount' => $request->discount
            ]);
            Goodsaccount::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'logo' =>$request->logo,
                'goods_class_id' => $request->goods_class_id,
                'is_by' => 1,
                'goodsnews_id'=>$add->id
            ]);
        });
        session()->flash('success', '商家注册成功!');
        return redirect()->route('goodsaccount.index');
    }
    //删除
    public function destroy(Goodsaccount $goodsaccount){
    $goodsaccount->delete();
    echo 'success';
    }
    //修改
    public function edit(Goodsaccount $goodsaccount){
        $rows=Goodsclass::all();
        $value=Goodsnews::find($goodsaccount->goodsnews_id);
        $goodsaccount['value']=$value;
        return view('goodsaccount.edit',compact('goodsaccount','rows'));
    }
    public function update(Request $request,Goodsaccount $goodsaccount){
        $this->validate($request,[
            'name'=>'required|min:2',
            'email'=>'required|email',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'estimate_time'=>'required',
        ],[
            'name.required'=>'商家名称不能为空!',
            'name.min'=>'商家名称不能大于2!',
            'email.required'=>'邮箱不能为空!',
            'email.email'=>'邮箱格式不对!',
            'brand.required'=>'品牌不能为空!',
            'on_time.required'=>'准时送达不能为空!',
            'fengniao.required'=>'是否蜂鸟配送不能为空!',
            'bao.required'=>'是否保标记不能为空!',
            'piao.required'=>'是否票标记不能为空!',
            'zhun.required'=>'是否准标记不能为空!',
            'start_send.required'=>'起送金额不能为空!',
            'send_cost.required'=>'配送费不能为空!',
            'estimate_time.required'=>'预计时间不能为空!',
        ]);
        if($request->logo){
            $goodsaccount->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'logo'=>$request->logo,
                'goods_class_id'=>$request->goods_class_id,
                'is_by'=>1
            ]);
            DB::update("update goodsnews set  
                shop_name='{$request->name}',
                brand=$request->brand,
                on_time=$request->on_time,
                fengniao=$request->fengniao,
                bao=$request->bao,
                piao=$request->piao,
                zhun=$request->zhun,
                start_send=$request->start_send,
                send_cost=$request->send_cost,
                estimate_time=$request->estimate_time,
                notice='{$request->notice}',
                discount='{$request->discount}' 
                where id=$goodsaccount->goodsnews_id");
        }else{
            $goodsaccount->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'goods_class_id'=>$request->goods_class_id,
                'is_by'=>1
            ]);
           DB::update("update goodsnews set  
                shop_name='{$request->name}',
                brand=$request->brand,
                on_time=$request->on_time,
                fengniao=$request->fengniao,
                bao=$request->bao,
                piao=$request->piao,
                zhun=$request->zhun,
                start_send=$request->start_send,
                send_cost=$request->send_cost,
                estimate_time=$request->estimate_time,
                notice='{$request->notice}',
                discount='{$request->discount}' 
                here id=$goodsaccount->goodsnews_id");
        }
        session()->flash('success','商家修改成功!');
        return redirect()->route('goodsaccount.index');
    }
    //审核验证
    public function check(Request $request){
//        var_dump($request->goodsaccount);die;
        DB::update("update goodsaccounts set is_by = 1 where id =$request->goodsaccount");
        session()->flash('success','审核成功!');
        return redirect()->route('goodsaccount.index');
    }
    //查看详情
    public function show(Goodsaccount $goodsaccount){
      $row=Goodsnews::find($goodsaccount->goodsnews_id);
      $id=$goodsaccount->id;
      $row['goodsaccount_id']=$id;
//      var_dump($row->goodsaccount_id);die;
      return view('goodsaccount.show',compact('row'));
    }
}
