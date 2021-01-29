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
                      <td><img src="{{ asset('images/profile_pictures/head_belize_hole.png') }}" alt="post picture" height="50px" class="img-rounded"></td>
                    @else
                        @foreach ($photos as $photo)
                            @if ($photo->id==$post->photo_id)
                            <td><img src="{{ asset('images/post_pictures/'.$photo->file.'') }}" alt="profile picture" width="50px" class="img-rounded"></td>
                            @endif
                        @endforeach
                    @endif


                    <td>{{ $post->user->name }}</td>
                    <td>{{ isset($post->category->name) ? $post->category->name : 'not categorized'  }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at->diffForHumans()  }}</td>
                    <td>{{ $post->updated_at->diffForHumans()  }}</td>
                    <td><a href="/admin/posts/{{ $post->id }}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                    <td><a href="{{ route('deletePost',$post->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                @endforeach
            @endif

        </tbody>
    </table>




@endsection
