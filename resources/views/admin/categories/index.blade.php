@extends('layouts.admin')

@section('content')
    <h5>Categories</h5>

<div class="col-md-6 col-sm-12">
<div class="col-md-11">

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
        <label for="create-category">create category</label>
        <input type="text" name="category" id="create-category" class="form-control input-sm">
        </div>
        <div class="form-group">
            <input type="submit" value="create category" class="btn btn-primary btn-sm">
        </div>
    </form>
    @include('includes.messages')


</div>
</div>

 <div class="col-md-6 col-sm-12">
    <table class="table table-hover">
        <tr>
            <thead>
                <th>ID</th>
                <th>Category</th>
                <th>created</th>
                <th>updated</th>
            </thead>
        </tr>
        @if ($categories)
        @foreach ($categories as $category)
            <tr>
                <tbody>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                    <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : 'no date' }}</td>
                    <td><a href="{{ route('editCategory',$category->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td><a href="{{ route('deleteCategory',$category->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tbody>
            </tr>
        @endforeach
        @endif

    </table>
   </div>
@endsection
