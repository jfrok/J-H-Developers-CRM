<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<img src="{{asset('/icons/full-main-logo-144x144.png')}}" style="position: absolute;" class="rounded" alt="">
@forelse($scripts as $script)
    {!!$script->description!!}
@empty
    none
@endforelse
</body>
</html>
