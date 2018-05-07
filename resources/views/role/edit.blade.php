@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('role.update',['role'=>$role])}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">角色名</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1"  value="{{$role->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">角色描述名称</label>
                <input type="text" class="form-control" name="display_name" id="exampleInputPassword1"  value="{{$role->display_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">描述</label>
                <input type="text" class="form-control" name="description" id="exampleInputPassword1"  value="{{$role->description}}">
            </div>
            <div class="checkbox">

                    {{--@php(var_dump($p->id))--}}

                @foreach($rows as $row)
                <label>
                    <input type="checkbox" name="permission[]" value="{{$row['id']}}" {{in_array($row['id'],$a)?'checked':''}}>{{$row['description']}}<br/>
                </label>
                @endforeach
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop