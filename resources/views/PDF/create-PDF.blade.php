<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{--<style>--}}
{{--    body{--}}
{{--        background-image: url("https://i.postimg.cc/Jnc9mKsR/Ontwerp-zonder-titel.png");--}}
{{--        background-repeat: no-repeat;--}}
{{--        background-size: contain;--}}
{{--    }--}}
{{--    .text-p{--}}
{{--        margin-left: 10%;--}}
{{--    }--}}
{{--</style>--}}
<body>
<img src="{{asset('/icons/WEBP/5.webp')}}" class="rounded" style="width: 200PX" alt="">
<div class="text-p">
@forelse($scripts as $script)
    <p>{!!$script->description!!}</p>
@empty
    none
@endforelse
</div>
</body>
</html>
