@extends('layouts.default')
@section('content')
    <div class="container">
        @if($apply->isNotEmpty())
        @foreach($apply as $value)
        <p>该活动报名人数:{{$value->name}}</p>
       @endforeach
        <h3>活动名称:{{$value->title}}</h3>
            @else
                <h3>该活动还没有商户报名</h3>
            @endif
    </div>
@stop