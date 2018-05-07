<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">饿了吧</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               {!! \App\Management::nav() !!}
            {{--@foreach(\App\Http\Controllers\ManagementController::top() as $row)--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$row->menu_name}}<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--@foreach($row->child as $value)--}}
                            {{--@if (\Illuminate\Support\Facades\Auth::user()->can($value->menu_url))--}}
                        {{--<li><a href="{{route($value->menu_url)}}">{{$value->menu_name}}</a></li>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</li>--}}
         {{--@endforeach--}}
                {{--<li class="active"><a href="{{route('goodsaccount.index')}}">商家账号管理<span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="{{route('goodsclass.index')}}">商家分类管理</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限/角色 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route('permission.index')}}">权限列表</a></li>--}}
                        {{--<li><a href="{{route('permission.create')}}">添加权限</a></li>--}}
                        {{--<li><a href="{{route('role.index')}}">角色列表</a></li>--}}
                        {{--<li><a href="{{route('role.create')}}">添加角色</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="{{route('admins.index')}}">管理员管理</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('revise')}}">修改密码</a></li>
                        @if(!\Illuminate\Support\Facades\Auth::user())
                        <li><a href="{{route('login.create')}}">登录</a></li>
                        @endif
                        @if(!\Illuminate\Support\Facades\Auth::user())
                        <li><a href="http://shop.eleb.com/goodsaccount/create">注册商家</a></li>
                        @endif
                        <li role="separator" class="divider"></li>
                        @if(\Illuminate\Support\Facades\Auth::user())
                        <li>
                            <form action="{{route('logout')}}" method="post">{{method_field('DELETE')}}{{csrf_field()}}<input type="submit" value="退出登录"></form></li>
                         @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>