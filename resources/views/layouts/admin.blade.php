<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>



    <link href="{{ asset('css/app.css') }}" rel="stylesheet">




    <link href="{{ asset('images/favi-icon.png') }}" rel="icon">


    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script> --}}
    {{-- {<script>tinymce.init({selector:'textarea'});</script>} --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Codehacking Admin</a>

            </div>








            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <div class="p-3">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>


                        </div>
                    </li>
              @endguest
            </ul>







            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="{{ route('users.index') }}">All users</a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">Create user</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-desktop"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts" class="collapse">
                            <li>
                                <a href="{{ route('posts.index') }}">All posts</a>
                            </li>
                            <li>
                                <a href="{{ route('posts.create') }}">Create post</a>
                            </li>
                            <li>
                                <a href="admin/comments">All Comments</a>
                            </li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-newspaper-o"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="categories" class="collapse">
                            <li>
                                <a href="{{ route('categories.index') }}">All categories</a>
                            </li>
                        </ul>
                    </li>









                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>












        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                         <h3>Admin Control Panel<h3><span><a href="\home" class="btn btn-primary btn-sm">Home</a><a class="btn btn-primary btn-sm ml-2" href="{{ route('welcome') }}">Landing page</a></span>
                        </div>

                        <hr>

                        <div class="bg-light">
                            {{-- content goes in here --}}
                            @yield('content')
                        </div>

                        <hr>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <hr>
            <div class="bg-primary text-center p-5 text-white">
                <p>
                    copyright &copy; <script>
                        var now=new Date();
                        document.write(now.getFullYear());
                        </script> Ryan Mwakio
                </p>
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
