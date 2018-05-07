@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>权限名</th>
                <th>显示名称</th>
                <th>权限描述</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
                <tr data-id="{{$row['id']}}">
                    <td>{{$row['id']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['display_name']}}</td>
                    <td>{{$row['description']}}</td>
                    <td>
                        <a href="{{route('role.edit',['role'=>$row])}}" class="btn btn-danger">修改</a>
                        <button class="btn btn-primary">删除</button>
                    </td>
                </tr>
            @endforeach
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
                    url: "role/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop