@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('event.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">名称</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="名称" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">详情</label>
                <script id="container" name="content" type="text/plain">
{!! old('content') !!}
                </script>
                <!-- 配置文件 -->
                <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                </script>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">报名开始时间</label>
                <input type="date" name="signup_start" class="form-control" id="exampleInputEmail1"  value="{{old('signup_start')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">报名结束时间</label>
                <input type="date" name="signup_end" class="form-control" id="exampleInputEmail1"  value="{{old('signup_end')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">开奖日期</label>
                <input type="date" name="prize_date" class="form-control" id="exampleInputEmail1"  value="{{old('prize_date')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">报名人数限制</label>
                <input type="number" name="signup_num" class="form-control" id="exampleInputEmail1"  value="{{old('signup_num')}}">
            </div>
            <div class="form-group">
                <label>是否已开奖</label>
                <input type="checkbox" name="is_prize"  value="1" {{old('is_prize')==1?'checked':''}}>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop
