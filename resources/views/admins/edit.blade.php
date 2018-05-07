@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('admins.update',['admins'=>$admin])}}" method="post">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" name="name" class="form-control"  placeholder="用户名" value="{{$admin->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="邮箱" value="{{$admin->email}}">
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
            <div>
                @foreach($rows as $row)
                    <label>
                        <input type="checkbox" name="role[]" value="{{$row['id']}}" {{in_array($row['id'],$a)?'checked':''}}>{{$row['description']}}<br/>
                    </label>
                @endforeach
            </div>
            @endif
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop