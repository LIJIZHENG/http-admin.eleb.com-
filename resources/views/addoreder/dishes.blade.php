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
                 <th>每日商品统计数</th>
                 <th>每月商品统计数</th>
                 <th>总计</th>
             </tr>
             <tr>
                 <td>
                 @foreach($t as $v)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>菜品名称</th>
                                 <th>菜品数量</th>
                             </tr>
                             <tr>
                                 <td>{{$v->shop_name}}</td>
                                 <td>{{$v->goods_name}}</td>
                                 <td>{{$v->amounts}}</td>
                             </tr>
                         </table>
                 @endforeach
                 </td>
                 <td>
                     @foreach($p as $co)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>菜品名称</th>
                                 <th>菜品数量</th>
                             </tr>

                             <tr>
                                 <td>{{$co->shop_name}}</td>
                                 <td>{{$co->goods_name}}</td>
                                 <td>{{$co->amounts}}</td>
                             </tr>
                         </table>
                     @endforeach
                 </td>
                 <td>
                     @foreach($q as $z)
                         <table>
                             <tr>
                                 <th>店铺名称</th>
                                 <th>菜品名称</th>
                                 <th>菜品数量</th>
                             </tr>
                             <tr>
                                 <td>{{$z->shop_name}}</td>
                                 <td>{{$z->goods_name}}</td>
                                 <td>{{$z->amounts}}</td>
                             </tr>
                         </table>
                     @endforeach
                 </td>
             </tr>
         </table>
    </div>
@stop
