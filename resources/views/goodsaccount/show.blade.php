@extends('layouts.default')
@section('content')
    <div class="container">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商家名称</th>
            <th>商家LOGO</th>
            <th>是否品牌</th>
            <th>是否准时送达</th>
            <th>是否蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否是准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>预计时间</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>操作</th>
        </tr>
        <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['shop_name']}}</td>
            <td><img src="{{$row['shop_img']}}" alt=""></td>
            <td>{{$row['brand']==1?"是":'否'}}</td>
            <td>{{$row['on_time']==1?"是":'否'}}</td>
            <td>{{$row['fengniao']==1?"是":'否'}}</td>
            <td>{{$row['bao']==1?"是":'否'}}</td>
            <td>{{$row['piao']==1?"是":'否'}}</td>
            <td>{{$row['start_send']}}</td>
            <td>{{$row['send_cost']}}</td>
            <td>{{$row['estimate_time']}}</td>
            <td>{{$row['notice']}}</td>
            <td>{{$row['discount']}}</td>
            <td>
                @if($row['is_by']==0)<a href="{{route('check',['goodsaccount'=>$row->goodsaccount_id])}}" class="btn btn-danger">审核通过</a>@endif
            </td>
        </tr>
    </table>
    </div>
@stop