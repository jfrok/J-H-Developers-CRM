{{--<div class="d-flex justify-content-end mb-4 pull-center">--}}
{{--    <a href="{{route('Page-generator',['download'=>'pdf'])}}" class="btn btn-primary">Export Page</a>--}}
{{--</div>--}}



<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">City</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    @php($counter = 1)
    @forelse($customers as $key => $customer)

        <tr>
            <th scope="row">{{$counter + $key}}</th>

            <td> <a href="{{url('/customers/customers-details/'.$customer->id)}}">{{$customer->fullname}}</a></td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->city}}</td>
            <td>{{\Carbon\Carbon::parse($customer->created_at)->format('d-F-Y')}}</td>

            <td>
                <button  class="editBtn btn btn-primary"  value="{{$customer->id}}" > <i class="bi bi-pencil-square"></i> Edit</button></td>
        </tr>

    @empty
        <tr>
            <td>There is no information</td>
        </tr>
    @endforelse
    </tbody>
</table>


