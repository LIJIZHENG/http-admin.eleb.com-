@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('enevt_prize.update',['enevt_prize'=>$enevt_prize])}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">奖品</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$enevt_prize->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">活动</label>
                <select name="events_id" class="form-control">
                    @foreach($rows as $row)
                    <option value="{{$row->id}}" {{$enevt_prize->events_id==$row->id?'selected':''}}>{{$row->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">奖品详情</label>
                <script id="container" name="description" type="text/plain">
                    {!! $enevt_prize->description !!}
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
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop
