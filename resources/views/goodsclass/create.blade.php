@extends('layouts.default')
@section('content')
    <div class="container">
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form action="{{route('goodsclass.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">商品分类名称</label>
            <input type="text" class="form-control" name="goods_class_name" id="exampleInputEmail1" placeholder="商品分类名称">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputFile">商品图片</label>--}}
            {{--<input type="file" id="exampleInputFile" name="goods_class_logo">--}}
        {{--</div>--}}

        <div class="form-group">
            <label>商品图片</label>
            <input type="hidden" name="goods_class_logo" class="form-control" id="logo">
        </div>
        <div class="form-group">
            <div id="uploader-demo">
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="" alt="" id="img">
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
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf:'/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            formData:{'_token':"{{csrf_token()}}"},
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response) {
            $("#img").attr('src',response.url);
            $("#logo").val(response.url);
        });
    </script>
@stop
