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
        </div>
      </div>
    </div>
  </article>


      @else
        {{ 'post not found' }}
     @endif



@endsection
