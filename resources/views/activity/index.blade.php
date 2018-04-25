@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $row)
        <tr data-id="{{$row['id']}}">
            <td>{{$row['id']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['start']}}</td>
            <td>{{$row['end']}}</td>
            <td>
                <a href="{{route('activity.edit',['activity'=>$row])}}" class="btn btn-warning">修改</a>
                <button class="btn btn-primary">删除</button>
                <a href="{{route('activity.show',['activity'=>$row])}}" class="btn btn-danger">查看活动详情</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <a href="{{route('activity.create')}}" class="btn btn-danger">添加</a>
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
                    url: "activity/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop