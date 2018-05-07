@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('management.update',['management'=>$management])}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">菜单名称</label>
                <input type="text" name="menu_name" class="form-control" id="exampleInputEmail1"  value="{{$management->menu_name}}" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">选择分类</label>
                <select name="parents_id">
                    <option value="0">顶级分类</option>
                    <?php foreach($categoryList_new as $category):?>
                    <option value="<?=$category['id']?>" {{$management->parents_id==$category['id']?'selected':''}}><?=$category['name_txt']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">菜单路径</label>
                <input type="text" name="menu_url" class="form-control" id="exampleInputEmail1"  value="{{$management->menu_url}}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">排序</label>
                <input type="number" name="floor" class="form-control" id="exampleInputEmail1"  value="{{$management->floor}}" >
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop
