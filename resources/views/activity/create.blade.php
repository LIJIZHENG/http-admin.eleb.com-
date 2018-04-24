@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('activity.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">活动名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="活动名称">
            </div>
            <div class="form-group">
                <script id="container" name="contents" type="text/plain">

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
                <label for="exampleInputEmail1">活动开始时间</label>
                <input type="date" name="start" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">活动结束时间</label>
                <input type="date" name="end" class="form-control" id="exampleInputEmail1">
            </div>
           {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop
