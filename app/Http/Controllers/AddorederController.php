<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddorederController extends Controller
{
    //
    public function amount(Request $request){
        $f="count(*)";
        $time=date('Y-m-d H:i:s',strtotime($request->time));
        $time1=date('Y-m-d 23:59:59',strtotime($request->dowtime));
        if($request->time){
            $a=DB::select("select count(*),addoreders.shop_name from addoreders where  order_birth_time>=? AND order_birth_time<=? GROUP BY shop_name",[$time,$time1]);
        }else{
            $a=DB::select("select count(*),addoreders.shop_id from addoreders where  order_birth_time>=? AND order_birth_time<=? GROUP BY shop_id",[date('Y-m-d 00:00:00',time()),date('Y-m-d 23:59:59',time())]);
        }
        if($request->month){
            $month=date("Y-m-d H:i:s",strtotime($request->month));
            $month1=date('Y-m-d 23:59:59', strtotime("$month+1month -1 day"));
            $r=DB::select("select count(*),addoreders.shop_name from addoreders WHERE order_birth_time>=? AND order_birth_time<=? GROUP by shop_name",[$month,$month1]);
        }else{
            $month=date('Y-m-t H:i:s', strtotime('-1 month'));
            $month1=date('Y-m-t 23:59:59', strtotime('0 month'));
            $r=DB::select("select count(*),addoreders.shop_name from addoreders WHERE order_birth_time>=? AND order_birth_time<=? GROUP by shop_name",[$month,$month1]);
        }
        $zong=DB::select("select count(*),addoreders.shop_name from addoreders GROUP BY shop_name");
        return view('addoreder.amount',['a'=>$a,'f'=>$f,'r'=>$r,'zong'=>$zong]);
    }
    public function dishes(Request $request){
        if($request->time){
            $time=date('Y-m-d H:i:s',strtotime($request->time));
            $time1=date('Y-m-d 23:59:59',strtotime($request->time));
            $t = DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.shop_id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$time],['ints.created_at','<=',$time1]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
        }else{
            $time=date('Y-m-d H:i:s',time());
            $time1=date('Y-m-d 23:59:59',strtotime($time));
            $t = DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.shop_id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$time],['ints.created_at','<=',$time1]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
        }
        if($request->month){
            $month=date("Y-m-1 H:i:s",strtotime($request->month));
           $month1=date('Y-m-d 23:59:59', strtotime("$month+1month -1 day"));
            $p = DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.shop_id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$month],['ints.created_at','<=',$month1]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
        }else{
            $month=date("Y-m-1 00:00:00",time());
            $month1=date('Y-m-d 23:59:59', strtotime("$month+1month -1 day"));
            $p = DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.shop_id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$month],['ints.created_at','<=',$month1]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
        }
        $q = DB::table('ints')
            ->join('addoreders','ints.order_id','=','addoreders.id')
            ->join('goodsnews','addoreders.shop_id','=','goodsnews.id')
            ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
            ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
            ->orderBy('amounts','desc')
            ->get();
//        dd($q);
        return view('addoreder.dishes',['t'=>$t,'p'=>$p,'q'=>$q]);
    }
}
