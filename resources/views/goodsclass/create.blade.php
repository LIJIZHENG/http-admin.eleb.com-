@extends('layouts.default')
@section('content')
    <div class="container">
    <form action="{{route('goodsclass.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">商品分类名称</label>
            <input type="text" class="form-control" name="goods_class_name" id="exampleInputEmail1" placeholder="商品分类名称">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">商品图片</label>
            <input type="file" id="exampleInputFile" name="goods_class_logo">
        </div>
        <div class="form-group">
            <label>验证码:</label>
            <div class="row">
                <div class="col-xs-3"><input id="captcha" class="form-control" name="captcha" ></div>
                <div class="col-xs-7"><img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
            </div>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-danger">添加</button>
    </form>
    </div>
@stop