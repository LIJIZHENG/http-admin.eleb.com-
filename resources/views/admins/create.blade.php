@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('admins.store')}}" method="post">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" name="name" class="form-control"  placeholder="用户名" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="邮箱" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop