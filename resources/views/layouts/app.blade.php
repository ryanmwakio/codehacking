<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Codehacking | Everything code</title>


    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clean-blog.css') }}" rel="stylesheet">



    <link href="{{ asset('images/favi-icon.png') }}" rel="icon">


    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white purple-shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Codehacking') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if ( Auth::check())
                        <a href="{{ route('welcome') }}" class="btn btn-outline-dark m-3">Landing Page</a>
                       @endif

                        @if ( Auth::check())
                        <a href="{{ route('home') }}" class="btn btn-outline-dark m-3">Profile Page</a>
                       @endif

                        @if ( Auth::check() && Auth::user()->isAdmin())
                         <a href="\admin" class="btn btn-outline-dark m-3">Admin Page</a>
                        @endif


                        @guest
                            <li class="nav-item btn btn-outline-dark m-2">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item btn btn-outline-dark m-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item nav-link">
                            @if (Auth::user()->photo_id==0 )
                              <img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile image" width="40px" class="img-circle">
                            @else
                              @foreach (App\Photo::all() as $photo)
                                @if ($photo->id==Auth::user()->photo_id)
                                 <td><img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" width="40px" class="img-circle"></td>
                                @endif
                              @endforeach
                            @endif

                        </li>
                            <li class="nav-item dropdown nav-link">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a href="{{ route('public.edit',Auth::user()->id) }}" class="dropdown-item bg-primary text-white mb-1">Edit Account</a>
                                    <a href="{{ route('deletePublicUser',Auth::user()->id) }}" class="dropdown-item bg-danger text-white">Delete Account</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-light p-4 text-center border-top">
            <p>&copy;<script>
                var now=new Date();
                document.write(now.getFullYear());
                </script> Ryan Mwakio</p>
        </footer>
    </div>
</body>
</html>
