@extends('layouts.app')

@section('content')


    @if ($post=App\Post::find($id))



        <!-- Page Header -->
            @if ($post->photo_id!=0)
                @if ($photo=App\Photo::find($post->photo_id))
                    <header class="masthead" style="background-image: url('{{ asset('images/post_pictures/'.$photo->file.'') }}')">
                @endif
            @else
                    <header class="masthead" style="background-image: url('{{ asset('images/post_pictures/post-placeholder.jpg') }}')">
            @endif



            <div class="overlay"></div>

            <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    <span class="meta">Posted by
                    <span>{{ $post->user->name }}</span>
                    &nbsp;{{ $post->created_at->diffForHumans() }}</span>
                </div>
                </div>
            </div>
            </div>
        </header>


         <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 mx-auto text-justify">
         <hr>
         {{ $post->body }}
         <hr>
         <div class="col-sm-10 col-md-5">
            @include('includes.messages')
         </div>
         @if (!Auth::check())
            <i class="text-success">*Login to comment*</i>
         @endif


         @if (Auth::check())
         <div class="card p-4 bg-light">

                <form action="{{ route('comments.store') }}" method="POST" class="col-md-6 col-sm-11">
                    @csrf
                    <div class="form-group">
                    <h6>Leave a comment:</h6>
                    </div>

                    <input type="hidden" name="postid" value={{ $post->id }}>

                    <div class="form-group">
                        <textarea name="comment" id="" cols="30" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="comment">
                    </div>
                </form>
         </div>
         @endif

{{-- view all comments --}}

    <div class="be-comment-block">


        @if ($comments=App\Comment::where('post_id',$post->id)->take(7)->orderBy('id','desc')->get())
            @if ($comments)
                <h1 class="comments-title">Comments ({{ $comments->count() }})</h1>
                @foreach ($comments as $comment)
                    @if ($user=App\User::find($comment->author))

                    <div class="be-comment">
                        <div class="be-img-comment">
                            <p>
                                @if ($user->photo_id==0 )
                                <img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile image" width="40px" class="be-ava-comment">
                                @else
                                @if ($photo=App\Photo::find($user->photo_id))
                                <img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" width="40px" class="be-ava-comment">
                                @endif
                                @endif
                            </p>
                        </div>

                        <div class="be-comment-content">

                            <span class="be-comment-name">
                                <p>{{ $user->name }}</p>
                            </span>
                            <span class="be-comment-time">
                                <i class="fa fa-clock-o"></i>
                                {{ $comment->created_at->diffForHumans() }}
                            </span>

                            <p class="be-comment-text">
                                {{ $comment->body }}
                            </p>

                            @if (Auth::id()==$user->id)
                                 <a href="/delete/comment/{{ $comment->id }}" class="btn btn-danger btn-sm">Delete</a>
                            @endif

                        </div>
                    </div>
                    @endif

                @endforeach
            @else
                <div class="alert alert-danger col-sm-10 col-md-5">
                    {{ 'No comments on the post at the moment!' }}
                </div>
                {{-- </div> --}}
            @endif
        @endif


    </div>
    {{-- view all comments End --}}






        </div>
      </div>
    </div>
  </article>


      @else
      <div class="container">
        <div class="alert alert-danger col-sm-10 col-md-5">
            {{-- <button class="close" type="button" data-dismiss="alert">
                <span>&times;</span>
            </button> --}}
            {{ 'post not found' }}
            <span><a href="{{ route('welcome') }}" class="text-primary">Go to landing page</a></span>
          </div>
      </div>


     @endif



@endsection
