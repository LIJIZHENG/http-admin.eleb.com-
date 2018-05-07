@extends('layouts.default')
@section('content')
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>会员名称</th>
                <th>电话号码</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr>
                <td>{{$row->username}}</td>
                <td>{{$row->tel}}</td>
                <td>
                    @if($row->status == 0)
                        正常
                    @elseif($row->status)
                        会员被禁用
                    @endif
                </td>
                <td>
                    @if($row->status == 0)
                        <a href="{{route('regist.show',['id'=>$row->id])}}" class="btn btn-danger">禁用</a>
                    @elseif($row->status == 1)
                        <a href="{{route('regist.edit',['id'=>$row->id])}}" class="btn btn-danger">恢复</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop