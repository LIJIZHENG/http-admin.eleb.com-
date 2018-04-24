@extends('layouts.default')
@section('content')
    <div class="container">
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('goodsaccount.update',['goodsaccount'=>$goodsaccount])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">商家名称</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="商家名称" value="{{$goodsaccount->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="邮箱" value="{{$goodsaccount->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">商品分类</label>
                <select name="goods_class_id" class="form-control">
                    @foreach($rows as $row)
                        <option value="{{$row['id']}}" {{$goodsaccount->class_id==$row['id']?'selected="selected"':''}}>{{$row['goods_class_name']}}</option>
                    @endforeach
                </select>
            </div>

            {{--<div class="form-group">--}}
                {{--<label for="exampleInputFile">商家图片</label>--}}
                {{--<img src="{{$goodsaccount->logo}}" alt="">--}}
                {{--<input type="file" id="exampleInputFile" name="logo">--}}
            {{--</div>--}}
            <div class="form-group">
                <label>商家图片</label>
                <input type="hidden" name="logo" class="form-control" id="logo">
            </div>
            <div class="form-group">
                <div id="uploader-demo">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img src="{{$goodsaccount->logo}}" alt="" id="img">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">是否是品牌</label>
                <input type="radio" name="brand" {{$goodsaccount->value->brand==1?'checked':''}} value="1">是/否
                <input type="radio" name="brand" {{$goodsaccount->value->brand==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                <label for="exampleInputPassword1">是否准时送达</label>
                <input type="radio" name="on_time" {{$goodsaccount->value->on_time==1?'checked':''}} value="1">是/否
                <input type="radio" name="on_time" {{$goodsaccount->value->on_time==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                <label for="exampleInputPassword1">是否是蜂鸟配送</label>
                <input type="radio" name="fengniao" {{$goodsaccount->value->fengniao==1?'checked':''}} value="1">是/否
                <input type="radio" name="fengniao" {{$goodsaccount->value->fengniao==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                <label for="exampleInputPassword1">是否保标记</label>
                <input type="radio" name="bao" {{$goodsaccount->value->bao==1?'checked':''}} value="1">是/否
                <input type="radio" name="bao" {{$goodsaccount->value->bao==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                <label for="exampleInputPassword1">是否保标记</label>
                <input type="radio" name="piao" {{$goodsaccount->value->piao==1?'checked':''}} value="1">是/否
                <input type="radio" name="piao" {{$goodsaccount->value->piao==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                <label for="exampleInputPassword1">是否是准标记</label>
                <input type="radio" name="zhun" {{$goodsaccount->value->zhun==1?'checked':''}} value="1">是/否
                <input type="radio" name="zhun" {{$goodsaccount->value->zhun==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input type="text" class="form-control" name="start_send" id="exampleInputEmail1" placeholder="起送金额" value="{{$goodsaccount->value->start_send}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input type="text" class="form-control" name="send_cost" id="exampleInputEmail1" placeholder="配送金额" value="{{$goodsaccount->value->send_cost}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">预计时间</label>
                <input type="text" class="form-control" name="estimate_time" id="exampleInputEmail1" placeholder="预计时间" value="{{$goodsaccount->value->estimate_time}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店公告</label>
                <input type="text" class="form-control" name="notice" id="exampleInputEmail1" placeholder="店公告" value="{{$goodsaccount->value->notice}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <input type="text" class="form-control" name="discount" id="exampleInputEmail1" placeholder="优惠信息" value="{{$goodsaccount->value->discount}}">
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
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