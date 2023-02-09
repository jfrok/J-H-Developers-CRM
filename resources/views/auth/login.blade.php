<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{asset('build/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('build/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{asset('build/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/simple-datatables.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/style.css')}}" rel="stylesheet">


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">


</head>
{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-input-label for="email" :value="__('Email')" />--}}
{{--                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--                <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-input-label for="password" :value="__('Password')" />--}}

{{--                <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password"--}}
{{--                                required autocomplete="current-password" />--}}

{{--                <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <!-- Remember Me -->--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-primary-button class="ml-3">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-primary-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}

<body>
{{--<div class="container">--}}
{{--    <div class="wrapper">--}}
{{--        <div class="title"><span>Login Form</span></div>--}}
{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}
{{--            <div class="row">--}}
{{--                <i class="fas fa-user"></i>--}}
{{--                <input type="email"  placeholder="Email" name="email" :value="old('email')" required autofocus >--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <i class="fas fa-lock"></i>--}}
{{--                <input type="password" name="password" placeholder="Password" required>--}}
{{--            </div>--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <div class="pass"><a href="{{ route('password.request') }}">Forgot password?</a></div>--}}
{{--            @endif--}}
{{--            <div class="row button">--}}
{{--                <input type="submit" value="Login">--}}
{{--            </div>--}}
{{--            <div class="signup-link">Not a member? <a href="{{ route('register') }}">Signup now</a></div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"> <a href="index.html" class="logo d-flex align-items-center w-auto"> <img src="assets/img/logo.png" alt=""> <span class="d-none d-lg-block">Admin</span> </a></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" >
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email"  placeholder="Email" name="email" class="form-control" :value="old('email')" required autofocus >
{{--                                            <input type="text" name="username" class="form-control" id="yourUsername" required>--}}
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label></div>
                                    </div>
                                    <div class="col-12"> <button class="btn btn-primary w-100" type="submit">Login</button></div>
                                    @if (Route::has('password.request'))
                                        <p class="small mb-0"><a href="{{ route('password.request') }}">Forgot password?</a></p>
                                    @endif
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="{{route('register')}}">Create an account</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
</body>
</html>
