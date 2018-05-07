@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts.default')
        <table class="table table-responsive">
            <tr>
                <th>ID</th>
                <th>活动</th>
                <th>人名</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->events->title}}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <a href="" class="btn btn-danger">添加</a>
                </td>
            </tr>
        </table>
    </div>
@stop
