<style>
    .navbar {
        background-color: #3173AD;
        height: 70px;
    }

    .navbar .container .navbar-collapse .navbar-left {
        padding-left: 0px;
    }
    .navbar .container .navbar-collapse .navbar-left,
    .navbar .container .navbar-collapse .navbar-right {
        padding-top: 10px;
    }

    .navbar .container .navbar-collapse .navbar-right .dropdown .dropdown-toggle:hover {
        background-color: #A4A4A4;
    }

    .navbar .container .navbar-collapse .navbar-right .link a:hover {
        background-color: #A4A4A4;
    }

    .navbar .container .navbar-collapse .navbar-right .dropdown .dropdown-toggle,
    .navbar .container .navbar-collapse .navbar-right .link a {
        font-size: 18px;
    }

    .navbar .container .navbar-header a {
        font-family: "Ubuntu Condensed";
        font-size: 25px;
    }

    .navbar .container .navbar-collapse .navbar-left .btn-primary:hover {
        background: #A4A4A4;
    }

    .navbar .container .navbar-header a,
    .navbar .container .navbar-collapse .navbar-right .dropdown .dropdown-toggle,
    .navbar .container .navbar-collapse .navbar-right .link a {
        color: white;
    }
</style>

<nav class="navbar navbar-fixed-top">
    <div class="container col-xs-6 col-xs-offset-3">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-tripadvisor" style="font-size: 40px"></i> gram</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(Auth::user())
                <form action="{{ route('find-user') }}" class="navbar-form navbar-left" role="search" method="get">
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Find</button>
                </form>
            @endif

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li class="link"><a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> SignIn</a></li>
                    <li class="link"><a href="{{ url('/register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> SignUp</a></li>
                @endif

                @if(Auth::user())
                    <li class="link"><a href="{{ route('home') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>
                    <li class="link"><a href="{{ route('upload') }}"><i class="fa fa-upload" aria-hidden="true"></i></a></li>

                    @if(Auth::user()->admin == true)
                        <li class="link"><a href="{{ route('message') }}"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    @else
                        <li class="link"><a href="{{ route('new-message') }}"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->username }} <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile', ['username' => auth()->user()->username]) }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                            <li><a href="{{ route('account') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                            @if(auth()->user()->admin == true)
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('users') }}"><i class="fa fa-users" aria-hidden="true"></i> All User</a></li>
                                <li><a href="{{ route('report') }}"><i class="fa fa-flag" aria-hidden="true"></i> All Report</a></li>
                            @endif
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>