@extends('layouts.admin')

@section('content')
    <h4>posts</h4>
    <hr>
    @include('includes.messages')
    <table class="table">
        <thead>
            <th>ID</th>
            <th>PHOTO</th>
            <th>USER</th>
            <th>CATEGORY</th>
            <th>TITLE</th>
            <th>BODY</th>
            <th>CREATED AT</th>
            <th>UPDATED AT</th>
        </thead>

        <tbody>
            @if ($posts)
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>


                    @if ($post->photo_id==0)
                      <td><img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="post picture" height="50px"></td>
                    @else
                      <td><img src="{{ $post->photo->file }}" height="50px" alt="post picture"></td>
                    @endif


                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at->diffForHumans()  }}</td>
                    <td>{{ $post->updated_at->diffForHumans()  }}</td>
                </tr>
                @endforeach
            @endif

        </tbody>
    </table>




@endsection
