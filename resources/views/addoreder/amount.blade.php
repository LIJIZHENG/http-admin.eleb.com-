@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="" method="get">
            开始时间:<input type="date" name="time">
            截止时间:<input type="date" name="dowtime">
            月份时间:<input type="date" name="month">
            <input type="submit" value="查看">
        </form>
         <table class="table table-responsive">
             <tr>
                 <th>每日商家统计</th>
                 <th>每月商家统计</th>
                 <th>总计</th>
             </tr>
             <tr>
                 <td>
                 @foreach($a as $v)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>订单数量</th>
                             </tr>
                             <tr>
                                 <td>{{$v->shop_name}}</td>
                                 <td>{{$v->$f}}</td>
                             </tr>
                         </table>
                 @endforeach
                 </td>
                 <td>
                     @foreach($r as $o)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>订单数量</th>
                             </tr>
                             <tr>
                                 <td>{{$o->shop_name}}</td>
                                 <td>{{$o->$f}}</td>
                             </tr>
                         </table>
                     @endforeach
                 </td>
                 <td>
                     @foreach($zong as $z)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>订单数量</th>
                             </tr>
                             <tr>
                                 <td>{{$z->shop_name}}</td>
                                 <td>{{$z->$f}}</td>
                             </tr>
                         </table>
                     @endforeach
                 </td>
             </tr>
         </table>
    </div>
@stop
