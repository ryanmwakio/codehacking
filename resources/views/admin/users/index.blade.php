
@extends('layouts.admin')

@section('content')
    <h4>Users</h4>

    @include('includes.messages')

    <div class="col-md-8 col-sm-12">
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>Id</th>
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
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ ($user->is_active==1) ? 'Active' : 'Not Active' }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach

            @endif

        </tbody>
    </table>
</div>
@endsection
