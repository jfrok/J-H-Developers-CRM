{{--<div class="modal fade" id="editHourModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    @include('includes.edit-hour-modal')--}}
{{--</div>--}}
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <div class="m4">
{{--                {{dd(\App\Models\Hours::workedAgreedPriceFromProject())}}--}}
{{--                {{$project->getWorkedHours()}}--}}
                @php($total = 0)
                @foreach($admins as $admin)
                    @php($costs = $admin->hour_cost * \App\Models\Hours::where('user_id',$admin->id)->sum('hours'))
                    @php($total += $costs)
                @endforeach
                <h3>Team progress </h3>
                <h2 class="text-center" style="color: #2eca6a">${{$total}} / {{\App\Models\Hours::workedAgreedPriceFromProject()}}<span style="color: #1a202c;font-size: 1.8rem"> / {{\App\Models\Hours::totalHours()}}</span></h2>
            </div>

        </div>
    </div>
</div>


@foreach($admins as $admin)
    @php($costs = $admin->hour_cost * \App\Models\Hours::where('user_id',$admin->id)->sum('hours'))


    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3>{{$admin->name}}</h3>
                <hr>
            </div>

            <ul class="list-group list-group-flush">

                @forelse(\App\Models\Hours::where('user_id',$admin->id)->get() as $hour)

                    @php($cost = $admin->hour_cost * \App\Models\Hours::getWorkedHours($hour->time_from,$hour->time_to))

                    <button class="editHourBtn" value="{{$hour->id}}"
                            style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;">
                        <li class="list-group-item" style="color: #4a5568">{{$hour->title}} <span
                                class="float-end font-bold"
                                style="color: green">{{\App\Models\Hours::getWorkedHours($hour->time_from,$hour->time_to)}} Hour ${{$cost}}</span></li>

                    </button>
                @empty
                    <h3>No Information</h3>
                @endforelse
            </ul>
            <div class="card-footer bg-transparent border-success">
                <h5 class="text-muted">Total <span class="ql-color-green" style="color: #2eca6a">${{$costs}}</span>
                </h5>
            </div>


        </div>
    </div>

@endforeach

