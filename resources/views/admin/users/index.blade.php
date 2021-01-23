
@extends('layouts.admin')

@section('content')
    <div class="text-center">
        <h4>Users</h4>
    </div>
    <hr>

    @include('includes.messages')

    <div class="col-md-10 col-sm-12">
    <table class="table table-responsive table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @if ($users)

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>

                        @if ($user->photo_id==0)
                            <td><img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="profile picture" width="50px" class="img-circle"></td>
                        @else
                            @foreach ($photos as $photo)
                                @if ($photo->id==$user->photo_id)
                                <td><img src="{{ asset('images/profile_pictures/'.$photo->file.'') }}" alt="profile picture" width="50px" class="img-circle"></td>
                                @endif
                            @endforeach

                        @endif

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ ($user->is_active==1) ? 'Active' : 'Not Active' }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td><a href="/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                        <td><a href="{{ route('deleteUser',$user->id) }}" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                @endforeach

            @endif

        </tbody>
    </table>
</div>
@endsection
