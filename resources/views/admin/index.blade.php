@extends('layouts.admin')

@section('content')
    <h5>admin Dashboard</h5>

    <hr>


    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>

                        @if ($users=App\User::all())
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $users->count() }}</div>
                            <div>Number of users</div>
                        </div>
                        @endif

                    </div>
                </div>
                <a href="{{ route('users.index') }}">
                    <div class="panel-footer">
                         <div>View all Your users</div>
                      <span class="pull-left">View Details</span>
                   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

         <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-photo fa-5x"></i>
                        </div>
                        @if ($posts=App\Post::all())
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $posts->count() }}</div>
                            <div>Number of posts</div>
                        </div>
                        @endif

                    </div>
                </div>
                <a href="{{ route('posts.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View all posts</span><br>
                        <span class="pull-left">View the details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


         <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>

                        @if ($categories=App\Category::all())
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $categories->count() }}</div>
                            <div>Number of categories</div>
                        </div>
                        @endif


                    </div>
                </div>
                <a href="{{ route('categories.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View all categories</span><br>
                        <span class="pull-left">view category details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

          <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">8</div>
                            <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View all categories</span><br>
                        <span class="pull-left">Total Comments</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


            </div> <!--First Row-->
@endsection
