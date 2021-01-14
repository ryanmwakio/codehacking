@extends('layouts.admin')

@section('content')
<h4>create post</h4>
<hr>

<div class="col-md-7 col-sm-12">
    @include('includes.messages')


    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category" class="form-control input-sm">

            @if ($categories)
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="photo">Post Picture:</label>
        <input type="file" name="picture" id="photo" class="form-control input-sm">
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control input-sm">
    </div>

    <div class="form-group">
       <label for="body">Post Body</label>
       <textarea name="body" id="body" cols="30" rows="4" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="create post" class="btn btn-primary btn-sm">
    </div>
    </form>
</div>
@endsection
