@extends('layouts.app')

@section('content')

      <!-- Page Header -->
  <header class="masthead hero" style="background-image: url('{{ asset('images/home-bg.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>CODEHACKING &LeftAngleBracket;/&RightAngleBracket;</h1>
            <span class="subheading">We talk everything codes and technology</span>
          </div>
        </div>
      </div>
    </div>
  </header>







  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-12 mb-3">


        @foreach (App\Post::orderBy('id','desc')->paginate(2) as $post)
         <div class="post-component">
            <div class="post-preview">
            <a href="public/post/{{ $post->id }}">
                <h2 class="post-title">{{ $post->title }}</h2>
            </a>
            <p class="post-meta">Posted by
                <span>{{ $post->user->name }}</span>
                &nbsp;{{ $post->created_at->diffForHumans() }}
            </p>
            @if ($post->photo_id!=0)
                @if ($photo=App\Photo::find($post->photo_id))
                 <div class="post-preview-img">
                    <a href="public/post/{{ $post->id }}">
                    <img src="{{ asset('images/post_pictures/'.$photo->file.'') }}" alt="post picture">
                    </a>
                 </div>
                @endif
            @else
              <div class="post-preview-img">
                <a href="public/post/{{ $post->id }}">
                <img src="{{ asset('images/post_pictures/post-placeholder.jpg') }}" alt="post picture">
                </a>
              </div>
            @endif
            </div>

           <div class="col-md-10 col-sm-12">
                <p>
                    @if (str_word_count($post->body)>150)
                         {{ substr($post->body,0,150) }}....
                    @else
                        {{ $post->body }}
                    @endif
                </p>
           </div>
          <hr>
         </div>
        @endforeach








        <!-- Pager -->
        <div class="col-md-6 col-sm-12 my-3">
            {{ App\Post::orderBy('id','desc')->paginate(2)->links() }}
        </div>
      </div>









       <!--right content-->
      <div class="col-md-4 col-sm-12">

           @if (Auth::check())

              <div class="post-component">
                  <hr>
                        <div class="col-12">

                          @if (Auth::user()->photo_id==0 )
                                <img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile image" width="40px" class="img-circle">
                            @else
                                @foreach (App\Photo::all() as $photo)
                                @if ($photo->id==Auth::user()->photo_id)
                                <td><a href="{{ route('home') }}"><img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" class="img-circle sidebar-img"></a></td>
                                @endif
                                @endforeach
                            @endif
                            <a href="{{ route('home') }}" class="m-2">&rarr;Go to profile</a>
                        </div>
                        <div class="col-6">
                            <button class="btn"><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></button>
                        </div>
                   <hr>
              </div>
            @endif









            <div class="post-component">
                <hr>
                <div>
                    <h6>categories</h6>
                    @if (App\Category::all())
                      @foreach (App\Category::all() as $category)
                        <div class="btn">{{ $category->name }}</div>
                       @endforeach
                    @endif
                </div>
                <hr>
            </div>









            <div class="post-component">
                <hr>
                    <p>Designed&amp;Developed by Ryan Mwakio</p>
                <hr>
            </div>







            <div class="post-component">
                <div>
                    <h6>contact</h6>
                    <a href="https://github.com/ryanmwakio" class="social-link" target="_blank" rel="noreferrer noopener">github</a>
                    <a href="https://twitter.com/ryanmwakio" class="social-link" target="_blank" rel="noreferrer noopener">twitter</a>
                    <a href="https://www.linkedin.com/in/ryan-mwakio-7347a51ba/" class="social-link" target="_blank" rel="noreferrer noopener">linked in</a>
                    <a href="mailto:ryanmwakio@yahoo.com" class="social-link">e-mail</a>
                </div>
            </div>



        </div><!--right content end-->





    </div><!--row end-->
  </div>
@endsection
