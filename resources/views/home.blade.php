@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.messages')
            <div class="card">
             <div class="cover-img">
               <img src="{{ asset('images/cover-img.jpg') }}" alt="cover image">
            </div>
            <div class="profile-img">
                @if (Auth::user()->photo_id==0 )
                              <img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile image" class="img-circle">
                            @else
                              @foreach (App\Photo::all() as $photo)
                                @if ($photo->id==Auth::user()->photo_id)
                                 <td><img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" class="img-circle"></td>
                                @endif
                              @endforeach
                            @endif
            </div>
            <hr>
            <div class="profile-details ml-1 mr-1">

            <div class="row">
                <span class="col-md-3 col-sm-12">
                     <h4 class="btn">{{ Auth::user()->name }}</h4>
                     <hr>
                     <p><h6>Email: </h6>{{ Auth::user()->email }}</p>
                     <hr>
                </span>
                <span class="col-md-3 col-sm-12">
                    <a href="{{ route('public.edit',Auth::user()->id) }}" class="btn btn-primary">update profile</a>
                    <hr>
                    <p><h6>Created:</h6>{{ Auth::user()->created_at->diffForHumans() }}</p>
                    <hr>
                </span>
                <span class="col-md-3 col-sm-12">
                    <a href="{{ route('deletePublicUser',Auth::user()->id) }}" class="btn btn-danger">delete profile</a>
                    <hr>
                    <p><h6>Updated:</h6>{{ Auth::user()->updated_at->diffForHumans() }}</p>
                    <hr>
                </span>
              </div>
            </div>

            <hr>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
