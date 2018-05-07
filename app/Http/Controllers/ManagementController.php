<?php

namespace App\Http\Controllers;

use App\Management;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    //
    public function index($parent_id=0){
        $categoryList=Management::all();
        $rows=$this->getChildren($categoryList,$parent_id);
        return view('management.index',compact('rows'));
    }

    public function create($parent_id=0){
        if(Auth::user()->can('management.create')){
        $categoryList=Management::all();
        $categoryList_new=$this->getChildren($categoryList,$parent_id);
        $permissions=Permission::all();
        return view('management.create',compact('categoryList_new','permissions'));
        }else{
            return '你没有改权限!';
        }
    }

    public function store(Request $request){
            $this->validate($request, [
                'menu_name' => 'required|unique:managements',
                'menu_url' => 'required',
//            'floor'=>'required',
            ], [
                'menu_name.required' => '菜单名称不能为空!',
                'menu_name.unique' => '菜单名称必需唯一!',
                'menu_url.required' => '菜单路径不能为空!',
                'menu_url.unique' => '菜单路径必须唯一!',
//            'floor.required'=>'排序不能为空!',
            ]);
            Management::create(['menu_name' => $request->menu_name, 'menu_url' => $request->menu_url, 'parents_id' => $request->parents_id, 'floor' => $request->parents_id]);
            session()->flash('success', '添加成功!');
            return redirect()->route('management.index');
    }

    public function edit(Management $management,$parent_id=0){
    if(Auth::user()->can('management.edit')) {
        $categoryList=Management::all();
        $categoryList_new=$this->getChildren($categoryList,$parent_id);
        return view('management.edit',compact('management','categoryList_new'));
    }else{
        return '你没有改权限!';
    }
    }

    public function update(Management $management,Request $request){
        $this->validate($request,[
            'menu_name'=>'required',
            'menu_url'=>'required',
        ],[
            'menu_name.required'=>'菜单名称不能为空!',
            'menu_url.required'=>'菜单路径不能为空!',
        ]);

        $management->update(['menu_name'=>$request->menu_name,'menu_url'=>$request->menu_url,'parents_id'=>$request->parents_id,'floor'=>$request->parents_id]);
        session()->flash('success','修改成功!');
        return redirect()->route('management.index');
    }

    public function destroy(Management $management){
        if(Auth::user()->can('management.destroy')) {
            $management->delete();
            echo 'success';
        }else{
            echo 403;
        }
    }

    public static function top(){
        $rows= DB::table('managements')->where('parents_id', '=',0)->get();
        foreach ($rows as $row){

             $val=DB::table('managements')->where('parents_id', '=',$row->id)->get();
            $row->child=$val;
        }
       return $rows;
    }



    private function getChildren(&$categoryList,$parent_id,$deep=0){
        static $children = [];//保存找到的儿子
        //循环所有的数据，比对每条数据中的parent_id,如果等于传入的$parent_id说明儿子找到了
        foreach ($categoryList as $child){
            if($child['parents_id'] == $parent_id){
                $child['name_txt'] = str_repeat("------",$deep*2).$child['menu_name'];//保存有缩进的名称
                $children[] = $child;
//                var_dump($children);
                $this->getChildren($categoryList,$child['id'],$deep+1);
            }
        }
        //返回找到的儿子
        return $children;
    }
}
