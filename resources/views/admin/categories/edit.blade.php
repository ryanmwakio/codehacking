@extends('layouts.admin')

@section('content')
    <div class="col-md-6 col-sm-12">
        <form action="{{ route('updateCategory',$category->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="category" id="" value="{{ $category->name }}" class="form-control input-sm">
            </div>
            <div class="form-group">
                <input type="submit" value="edit category" class="btn btn-primary btn-sm">
            </div>
        </form>
        @include('includes.messages')
    </div>
@endsection
