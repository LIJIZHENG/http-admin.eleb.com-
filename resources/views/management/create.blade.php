@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('management.store')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">菜单名称</label>
                <input type="text" name="menu_name" class="form-control" id="exampleInputEmail1" placeholder="菜单名称" {{old('menu_name')}}>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">选择分类</label>
                <select name="parents_id">
                    <option value="0">顶级分类</option>
                    <?php foreach($categoryList_new as $category):?>
                    <option value="<?=$category['id']?>" {{old('id')==$category['id']?'selected':''}}><?=$category['name_txt']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">菜单路径</label>
                <select name="menu_url">
                    <?php foreach($permissions as $permission):?>
                    <option value="<?=$permission['name']?>" ><?=$permission['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">排序</label>
                <input type="number" name="floor" class="form-control" id="exampleInputEmail1" placeholder="排序" {{old('floor')}}>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">添加</button>
        </form>
    </div>
@stop
