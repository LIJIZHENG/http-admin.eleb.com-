@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('goodsaccount.index')}}" class="navbar-form navbar-left" role="search" method="get">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="搜索内容">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>商家名称</th>
                <th>商家邮箱</th>
                <th>商家分类</th>
                <th>商家LOGO</th>
                <th>是否通过审核</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row['id']}}" id="{{$row['goodsnews_id']}}">
                <td>{{$row['id']}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['email']}}</td>
                <td>{{$row->goodsclass->goods_class_name}}</td>
                <td><img src="{{$row['logo']}}" alt=""></td>
                <td>@if($row['is_by'])审核通过@else未审核@endif</td>
                <td>
                    <a href="{{route('goodsaccount.show',['goodsaccount'=>$row])}}" class="btn btn-danger">查看详情</a>
                    <a href="{{route('goodsaccount.edit',['goodsaccount'=>$row])}}" class="btn btn-warning">修改</a>
                  <button class="btn btn-primary">删除</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    <a href="{{route('goodsaccount.create')}}" class="btn btn-danger">添加</a>
                </td>
            </tr>
        </table>
    </div>
    {{--{{$rows->links()}}--}}
@stop
@section('js')
    <script>
        $(".btn-primary").click(function () {
            var tr=$(this).closest('tr');
            if(confirm('是否删除数据!')){
                var id=tr.data('id');
                $.ajax({
                    type: "DELETE",
                    url: "goodsaccount/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
        $(".btn-primary").click(function () {
            var tr=$(this).closest('tr');
                var id=tr.attr('id');
                $.ajax({
                    type: "DELETE",
                    url: "goodsnews/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
        });
    </script>
@stop