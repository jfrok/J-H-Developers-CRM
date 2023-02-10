@forelse($customerQ as $customer)
    <a href="{{url('/customers/customers-details/'.$customer->id)}}" class="btn btn-light">
        {{$customer->fullname}}
{{--        {{$customer->email}}--}}
    </a>

@empty
No customers founded
@endforelse
{{--@if($projectQ->count() > 1)--}}
@forelse($projectQ as $project)
    <a href="{{url('/projects/details/'.$project->id)}}" class="btn btn-light">
        {{$project->title}}
    </a>
@empty
    No projects founded
@endforelse
{{--@endif--}}
