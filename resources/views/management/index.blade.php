@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>菜单名称</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr>
                <td>{{$row['id']}}</td>
                <td>{{$row['name_txt']}}</td>
                <td>
                    @role('management.edit')
                    <a href="{{route('management.edit',['management'=>$row])}}" class="btn btn-group">修改</a>
                    @endrole
                    @role('management.destroy')
                    <button class="btn btn-primary">删除</button>
                    @endrole
                </td>
            </tr>
            @endforeach
            @role('management.create')
            <tr>
                <td colspan="4">

                    <a href="{{route('management.create')}}" class="btn btn-danger">添加</a>
                </td>
            </tr>
            @endrole
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
                    url: "management/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop