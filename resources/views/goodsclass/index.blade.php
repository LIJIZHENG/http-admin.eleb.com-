@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>分类名称</th>
                <th>分类图片</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row['id']}}">
                <td>{{$row['id']}}</td>
                <td>{{$row['goods_class_name']}}</td>
                <td><img src="{{$row['goods_class_logo']}}" alt=""></td>
                <td>
                    <a href="{{route('goodsclass.edit',['goodsclass'=>$row])}}" class="btn btn-warning">修改</a>
                    <button class="btn btn-primary">删除</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <a href="{{route('goodsclass.create')}}" class="btn btn-danger">添加</a>
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
                    url: "goodsclass/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop