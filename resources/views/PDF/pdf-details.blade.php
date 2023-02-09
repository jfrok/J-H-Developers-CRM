@isset($customers)
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>
<body>
<h2>J&H</h2>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">City</th>
        <th scope="col">Date</th>
    </tr>
    </thead>

    <tbody>
    {{--        @forelse($customers as $customer)--}}

    <tr>
        {{--                <th scope="row">1</th>--}}
        <td>{{$customers->id}}</td>
        <td> {{$customers->fullname}}</td>
        <td>{{$customers->email}}</td>
        <td>{{$customers->city}}</td>
        <td>{{\Carbon\Carbon::parse($customers->created_at)->isoFormat('D MMMM YYYY')}}</td>

    </tr>

    {{--        @empty--}}
    {{--            <tr>--}}
    {{--                <td>There is no information</td>--}}
    {{--            </tr>--}}
    {{--        @endforelse--}}
    </tbody>
</table>
<div class="container">
    <div class="row">
        {{$customers->description}}
    </div>
    <hr>
    <h4>Messages</h4>
    <hr>
    <div class="row" style="height: auto; overflow-y: scroll; max-height: 500px">

        @forelse($messages as $message)

            {{--                    {{\Carbon\Carbon::parse(date($message->created_at))->format('d-F-Y')}}--}}
            {{\Carbon\Carbon::parse($message->created_at)->isoFormat('D MMMM YYYY')}}
            <br>
            {{$message->subject}}
            <br>
            {!! $message->message !!}
            <hr>
        @empty
            <h4>No contact</h4>
        @endforelse
    </div>
</div>
</body>
</html>

@endisset
