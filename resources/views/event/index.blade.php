@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数限制</th>
                <th>是否已开奖</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row->id}}">
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{date("Y-m-d",$row->signup_start)}}</td>
                <td>{{date("Y-m-d",$row->signup_end)}}</td>
                <td>{{date("Y-m-d",$row->prize_date)}}</td>
                <td>{{$row->signup_num}}</td>
                <td>{{$row->is_prize==1?'是':'否'}}</td>
                <td>
                    <a href="{{route('event.edit',['event'=>$row])}}" class="btn btn-danger">修改</a>
                    <button class="btn btn-primary">删除</button>
                    <a href="{{route('event.show',['event'=>$row])}}" class="btn btn-danger">查看活动详情</a>
                    <a href="/apply?id={{$row->id}}" class="btn btn-danger">报名情况</a>
                    <a href="{{route('enevt_prize.create',['id'=>$row->id])}}" class="btn btn-danger">添加活动奖品</a>
                    @if(date("Y-m-d",$time)==date("Y-m-d",$row->prize_date))
                    <a href="/start?id={{$row->id}}" class="btn btn-danger">开奖</a>
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8">
                    <a href="/lottery" class="btn btn-danger">所有活动抽奖结果</a>
                    <a href="{{route('event.create')}}" class="btn btn-danger">添加</a>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('js')
    <script>
        $(".btn-primary").click(function () {
            var tr=$(this).closest('tr');
            if(confirm('是否删除数据!')){
                var id=tr.data('id');
                $.ajax({
                    type: "DELETE",
                    url: "event/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop