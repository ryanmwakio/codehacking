@extends('layouts.admin')

@section('content')
    <div class="text-center">
        <h4>Edit User</h4>
    </div>
    <hr>


    <div class="col-md-8 col-sm-12">

        @include('includes.messages')


        <div class="row">
            <div class="col-md-4 col-sm-12">
                @if ($user->photo_id==0)
             <div class="text-center">
                <td><img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile picture" width="200px" class="img-circle"></td>
            </div>
            @else
            <div class="text-center">
                 {{-- <td><img src="{{ $user->photo->file }}" alt="profile picture" width="200px" class="img-circle"></td> --}}

                    @foreach (App\Photo::all() as $photo)
                        @if ($photo->id==$user->photo_id)
                         <td><img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" width="200px" class="img-circle"></td>
                        @endif
                    @endforeach
            </div>
            @endif
            </div>
            <div class="col-md-6 col-sm-12">
                <form action="/user/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control input-sm" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control input-sm" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control input-sm">
                    </div>

                    <div class="form-group">
                    <label for="picture">Picture:</label>
                    <input type="file" name="picture" id="picture" class="form-control input-sm">
                    </div>

                    <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control input-sm">
                        @if ($user->is_active==0)
                          <option value="{{ $user->is_active }}">Not Active</option>
                        @else
                          <option value="{{ $user->is_active }}">Active</option>
                        @endif

                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control input-sm">

                        @if ($user->role_id==1)
                         <option value="{{ $user->role_id }}">administrator</option>
                        @elseif($user->role_id==2)
                         <option value="{{ $user->role_id }}">author</option>
                        @elseif($user->role_id==3)
                         <option value="{{ $user->role_id }}">subscriber</option>
                        @endif


                        @if ($roles)
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif

                    </select>
                    </div>

                    <input type="submit" value="Edit user" class="btn btn-primary btn-sm" name="submit">
                </form>
            </div>
        </div>



   </div>
@endsection

