@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('login.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">用户名</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="用户名">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">记住我</label>
                <input type="checkbox" id="exampleInputFile" name="remember" value="1">
            </div>
            <div class="form-group">
                <label>验证码:</label>
                <div class="row">
                    <div class="col-xs-3"><input id="captcha" class="form-control" name="captcha" ></div>
                    <div class="col-xs-7"><img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
                </div>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-warning">登录</button>
        </form>
    </div>
@stop