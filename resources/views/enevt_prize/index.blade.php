@extends('layouts.default')
@section('content')
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>奖品名称</th>
                <th>活动</th>
                <th>奖品详情</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->events->title}}</td>
                <td>{!! $row->description !!}</td>
                <td>
                    <a href="{{route('enevt_prize.edit',['enevt_prize'=>$row])}}" class="btn btn-danger">修改</a>
                    <button class="btn btn-primary">删除</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <a href="{{route('enevt_prize.create')}}" class="btn btn-danger">添加</a>
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
                    url: "enevt_prize/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop