@extends('layouts.admin')

@section('content')
    <h4>posts</h4>
    <hr>
    @include('includes.messages')
    <table class="table">
        <thead>
            <th>ID</th>
            <th>USER</th>
            <th>CATEGORYID</th>
            <th>PHOTOID</th>
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
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category_id }}</td>
                    <td>{{ $post->photo_id }}</td>
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
