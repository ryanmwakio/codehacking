
@extends('layouts.app')

@section('content')
    <div class="bg-dark text-center p-3">
        <h5 class=" text-white font-weight-lighter">Sorry page not found! (404) <a href="{{ route('home') }}" class="btn btn-outline-light m-2">Go to Home Page</a><a href="{{ route('welcome') }}" class="btn btn-outline-light m-2">Go to Landing Page</a></h5>

    </div>
@endsection
