@extends('layouts.admin')

@section('content')
    <h4>Create User</h4>

    <div class="col-md-7 col-sm-12">

        @include('includes.messages')


        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control input-sm">
            </div>

            <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control input-sm">
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
                <option value="1">Active</option>
                <option value="0">Not Active</option>
            </select>
            </div>

            <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control input-sm">
                @if ($roles)
                    @foreach ($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                @endif

            </select>
            </div>

            <input type="submit" value="create user" class="btn btn-primary btn-sm" name="submit">
        </form>


   </div>
@endsection
