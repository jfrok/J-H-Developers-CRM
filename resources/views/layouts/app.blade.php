<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- PWA  -->
    <link rel="icon" href="{{asset('favicon.icon')}}" />

    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title' ?? 'J&H')</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('fullcalendar/main.css') }}" rel="stylesheet">
    <script src="{{ asset('fullcalendar/main.js') }}"></script>

    <link href="{{asset('build/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('build/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{asset('build/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/simple-datatables.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/css/style.css')}}" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

</head>

<body>
<style>
    .preloader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .4s ease;
        z-index: 999;
    }

    .fade-out-animation {
        opacity: 0;
        visibility: hidden;
    }

    .select2-container .select2-selection--single {
        height: 40px;
        line-height: 125;
        padding-top: 0.6rem;
        border: 1px solid #ced4da;
    }

</style>

<div class="preloader-wrapper">

    <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    {{--            <div class="spinner-border" role="status">--}}
    {{--                <span class="visually-hidden">Loading...</span>--}}
    {{--            </div>--}}

</div>

{{--        <div class="min-h-screen bg-gray-100">--}}

<div class="noti-loader">
    @include('layouts.navigation')
</div>

{{--            <!-- Page Heading -->--}}
{{--            @if (isset($header))--}}
{{--                <header class="bg-white shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

<!-- Page Content -->

<main id="main" class="main">

    @yield('content')
</main>

<footer id="footer" class="footer">
    <div class="copyright"> &copy; Copyright <strong><span>Compnay Name</span></strong>. All Rights Reserved</div>

</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function successMessage(title = "Success!", text) {
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: text,
            confirmButtonText: "Ok",
            confirmButtonColor: "#FA4D09",
        });
    }
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    const preloaderWrapper = document.querySelector('.preloader-wrapper');

    window.addEventListener('load', function () {
        preloaderWrapper.classList.add('fade-out-animation');
    });</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('scripts')
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<script>
    function getNoti() {
        $.ajax({
            url: '{{route('get-notification')}}',
            type: 'GET',
            success: function (data) {
                $('.noti-loader').empty().append(data)
            }
        })
    }

    $(document).ready(function () {
        $('#query').on('keyup', function () {
            if ($('#query').val() === '') {
                $('.sugg').css("display", "none")
            } else {
                $('.sugg').css("display","")
            }
        });
    });


    function generalSearch() {
        let searchQuery = $('#query').val();
        // empty()
        $.get('/generalSearch', {searchQuery: searchQuery}, function (data) {
            $('.getSugg').empty().append(data)
        });

    }
</script>

<script src="{{asset('build/assets/js/apexcharts.min.js')}}"></script>
<script src="{{asset('build/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('build/assets/js/chart.min.js')}}"></script>
<script src="{{asset('build/assets/js/echarts.min.js')}}"></script>
<script src="{{asset('build/assets/js/quill.min.js')}}"></script>
<script src="{{asset('build/assets/js/simple-datatables.js')}}"></script>
<script src="{{asset('build/assets/js/tinymce.min.js')}}"></script>
<script src="{{asset('build/assets/js/validate.js')}}"></script>
<script src="{{asset('build/assets/js/main.js')}}"></script>

</body>
</html>
