<a onclick="getProjectRequest()">test</a>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Customer</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    @forelse($projects as $project)
@php($customerName = \App\Models\Customer::find($project->customer_id))
        <tr>
            <th scope="row">1</th>

            <td> <a href="{{url('/projects/details/'.$project->id)}}">{{$project->title}}</a></td>
            <td> <a href="{{url('/customers/customers-details/'.$project->customer_id)}}">{{ $customerName->fullname ?? '' }}</a></td>
            {{--            <td>{{$project->email}}</td>--}}
{{--            <td>{{$project->city}}</td>--}}
            <td>{{\Carbon\Carbon::parse($project->created_at)->format('d-F-Y')}}</td>

            <td>
                <button  class="editBtn btn btn-primary"  value="{{$project->id}}" > <i class="bi bi-pencil-square"></i> Edit</button></td>
        </tr>

    @empty
        <tr>
            <td>There is no information</td>
        </tr>
    @endforelse
    </tbody>
</table>



