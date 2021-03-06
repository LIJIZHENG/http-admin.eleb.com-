@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>等级</th>
                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                <th>操作</th>
                @endif
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row->id}}">
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->is_admin==1?'超级管理员':'普通管理员'}}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                <td>
                    <a href="{{route('admins.edit',['admins'=>$row])}}" class="btn btn-warning">修改</a>
                    <button class="btn btn-primary">删除</button>
                </td>
               @endif
            </tr>
            @endforeach
            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
            <tr>
                <td colspan="6">
                    <a href="{{route('admins.create')}}" class="btn btn-danger">添加</a>
                </td>
            </tr>
            @endif
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
                    url: "admins/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
   </script>
@stop
