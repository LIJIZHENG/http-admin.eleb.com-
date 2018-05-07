@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('permission.update',['permission'=>$permission])}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">权限名</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{$permission->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">描述名称</label>
                <input type="text" class="form-control" name="display_name" id="exampleInputPassword1" value="{{$permission->display_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">描述</label>
                <input type="text" class="form-control" name="description" id="exampleInputPassword1" value="{{$permission->description}}">
            </div>
            {{--<div class="checkbox">--}}
                {{--<label>--}}
                    {{--<input type="checkbox"> Check me out--}}
                {{--</label>--}}
            {{--</div>--}}
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop