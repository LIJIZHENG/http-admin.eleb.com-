@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('enevt_prize.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">奖品</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="奖品" value="{{old('name')}}">
                <input type="hidden"  name="events_id" value="{{$id}}">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">奖品详情</label>
                <script id="container" name="description" type="text/plain">
                    {!! old('description') !!}
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
           {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop
