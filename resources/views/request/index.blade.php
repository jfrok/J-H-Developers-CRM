@extends('layouts.guest')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">How can we help you</h5>

    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Website</h5>
<p class="card-text">If you want a website like  way to showcase your work and let others know about yourself. <br>
    It's like an evergreen platform for your projects, case studies, and information about you.
    In addition, it's one of the best ways to express your personality, experience, and capabilities</p>

            <a href="{{route('request.website')}}">go to website form</a>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Software</h5>
            <p class="card-text">
                If you want a software where like you want to control your employers information or your project and customers and many other things that you can ask us to do  <br></p>

            <a href="{{route('request.software')}}">go to software form</a>

        </div>
    </div>
{{--    <div class="card">--}}
{{--        <div class="card-body">--}}
{{--            <h5 class="card-title">webshop</h5>--}}
{{--            <p class="card-text">If you want a website like  way to showcase your work and let others know about yourself. <br>--}}
{{--                It's like an evergreen platform for your projects, case studies, and information about you.--}}
{{--                In addition, it's one of the best ways to express your personality, experience, and capabilities</p>--}}

{{--            <a href="">go to website form</a>--}}

{{--        </div>--}}
{{--    </div>--}}
        </div>
    </div>
@endsection
@section('scripts')
@endsection
