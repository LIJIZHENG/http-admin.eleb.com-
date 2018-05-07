@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('role.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">角色名</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="角色名" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">角色描述名称</label>
                <input type="text" class="form-control" name="display_name" id="exampleInputPassword1" placeholder="角色描述名称" value="{{old('display_name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">描述</label>
                <input type="text" class="form-control" name="description" id="exampleInputPassword1" placeholder="描述" value="{{old('description')}}">
            </div>
            <div class="checkbox">
                @foreach($rows as $row)
                <label>
                    <input type="checkbox" name="permission[]" value="{{$row['id']}}">{{$row['description']}}<br/>
                </label>
                @endforeach
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop