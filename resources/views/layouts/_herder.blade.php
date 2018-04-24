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
                <li class="active"><a href="{{route('goodsaccount.index')}}">商家账号管理<span class="sr-only">(current)</span></a></li>
                <li><a href="{{route('goodsclass.index')}}">商家分类管理</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('admins.index')}}">管理员管理</a></li>
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