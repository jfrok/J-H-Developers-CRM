@extends('layouts.app')
@section('content')
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>The page you are looking for doesn't exist.</h2>
            <a class="btn" href="{{route('dashboard')}}">Back to home</a> <img src="{{asset('build/assets/img/not-found.svg')}}" class="img-fluid py-5" alt="Page Not Found">
{{--            <div class="credits"> Love by <a href="javascript:void(0)">J&H</a></div>--}}
        </section>
    </div>
@endsection
@section('scripts')
@endsection
