@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center bg-light p-3">
            <h4 class="">update your user details</h4>
        </div>
        <hr>


        <div class="col-md-8 col-sm-12">




            <div class="row">
                <div class="col-md-4 col-sm-12">
                    @if (Auth::user()->photo_id==0)
                 <div class="text-center">
                    <td><img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile picture" width="200px" class="img-circle"></td>
                </div>
                @else
                <div class="text-center">
                     <td><img src="{{ Auth::user()->photo->file }}" alt="profile picture" width="200px" class="img-circle"></td>
                </div>
                @endif
                </div>


                <div class="col-md-6 col-sm-12">
                    <div class="justify-content-center">
                        @include('includes.messages')
                    </div>

                    <form action="/user/public/update/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control input-sm" value="{{ Auth::user()->name }}">
                        </div>

                        <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control input-sm" value="{{ Auth::user()->email }}">
                        </div>

                        <div class="form-group">
                        <label for="picture">Picture:</label>
                        <input type="file" name="picture" id="picture" class="form-control input-sm">
                        </div>



                        <input type="submit" value="Update Details" class="btn btn-primary btn-sm" name="submit">
                    </form>
                </div>
            </div>



       </div>
    </div>
@endsection
