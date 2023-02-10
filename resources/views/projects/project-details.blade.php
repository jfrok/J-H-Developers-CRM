@extends('layouts.app')
@section('content')

    <section class="section">

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Project Registration</h5>
                        <div id="chart" style=" max-width: 650px;
  margin: 35px auto;"></div>
                        <table class="table">
                            <thead class="table-dark" style="width: 100%">
                            <th>Order Overview</th>
                            <th></th>
                            <th></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><strong>Customer</strong></td>
                                {{--                            <td>:</td>--}}
                                <td>
                                    <a href="{{url('/customers/customers-details/'.$project->customer_id)}}">{{$customer->fullname ?? ''}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Hours / Price</strong></td>
                                {{--                            <td>:</td>--}}
                                <td>{{$project->set_hours}} / <span
                                        style="color: #2eca6a">${{$project->set_hours * $project->set_price}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Agreed / Work</strong></td>
                                {{--                            <td>:</td>--}}
                                <td>{{$project->workedAgreedPrice()}} / {{$project->getWorkedHours()}}</td>
                            </tr>
                            <tr>
                                <td><strong>Cost</strong></td>
                                {{--                            <td>:</td>--}}
                                <td>{{$project->set_price}}</td>
                            </tr>
                            <tr>
                                <td><strong>Created at</strong></td>
                                {{--                            <td>:</td>--}}
                                <td>{{$project->created_at->format('d M Y')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Project Details</h5>
                        <div class="row mb-3" style="display: flex; justify-content: center">
                            {{--                            <label class="col-sm-2 col-form-label">Floating labels</label>--}}
                            <div class="col-sm-10">
                                <form id="projectEditFrom">
                                <div class="form-floating mb-3">
                                    <input type="text" name="edit_title" class="form-control"
                                                                       id="floatingInput" value="{{$project->title}}"
                                    >
                                    <label
                                        for="floatingInput">Title</label></div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control"  placeholder="Description"
                                              id="floatingTextarea" readonly
                                              style="height: 100px;">{{$customer->description ?? ''}}</textarea><label
                                        for="floatingTextarea">Info</label></div>
                                    <label for="floatingSelect">The Selected Customer</label>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" style="width: 100%;" name="customer_id" id="customerId_edit" aria-label="Floating label select example" class="browser-default">
                                            {{--                                        <option value="{{$customer->id}}" selected>{{$customer->fullname}}</option>--}}
                                            @foreach($customers as $customerAll)
                                                @if($customers != null)
                                                <option value="{{ $project->customer_id == $customerAll->id ? $project->customer_id : $customerAll->id  }}" {{ $customer->id == $customerAll->id ? 'selected' : ''}}>{{ ($customer->id == $customerAll->id ? $customer->fullname : $customerAll->fullname ) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="inputZip" class="form-label">Set Hours</label>
                                        <input type="number" name="set_hours" value="{{$project->set_hours}}" class="form-control" id="inputZip">
                                        </div>
                                    <div class="col-md-4"> <label for="inputZip" class="form-label">Set Price</label>
                                        <input type="number" name="set_price" value="{{$project->set_price}}" class="form-control" id="inputZip">
                                    </div>
                                    </div>
                                <div class="form-floating mb-3 mt-2">
                                    <textarea class="form-control" placeholder="Description"
                                              id="CK-description" name="description_edit"
                                              style="height: 100px;">{{$project->description}}</textarea>
                                </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" name="status"
                                                aria-label="Floating label select example">
{{--                                            <option selected="">Open this select menu</option>--}}
                                            <option value="pending" {{$project->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="ready" {{$project->status == 'ready' ? 'selected' : ''}}>Ready</option>
                                            <option value="delivered" {{$project->status == 'delivered' ? 'selected' : ''}}>Delivered</option>
                                            <option value="drop" {{$project->status == 'drop' ? 'selected' : ''}}>Drop</option>
                                        </select>
                                        <label for="floatingSelect">Works with selects</label>
                                    </div>

                                    <div class="icon d-flex justify-content-end" style="font-size: 50px">
                                        <a href="javascript:void(0)" onclick="saveProject()" style="color: rgba(52,50,50,0.97)">
                                        <i class="ri-hard-drive-2-fill"></i>
                                        </a>
                                        <button type="submit" id="submit" style="display: none"></button>
{{--                                        <div class="label">Save</div>--}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">

                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Activity's</h5>
                        <table class="table">
                            <thead class="table-dark" style="width: 100%">
                            <th>Logbook</th>
                            <th></th>
                            <th>At</th>
                            </thead>
                            <tbody>
                            @if($workedHours->count() > 0 )
                                @forelse($workedHours as $workHour)
                                    <tr>
                                        <td><strong>{{$workHour->title}}</strong></td>
                                        <td>:</td>
                                        <td>{{($workHour->created_at)->format('d M Y')}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Worked hours founded</td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title">Chart</h5>--}}


{{--            </div>--}}
{{--        </div>--}}
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>


    <script>
$('.select2-selection').css({'height': '100px'});
        var options = {
            series: [{
                name: 'Hours',
                        data: [{{ $chartData['WorkedHours'] }}, {{ $chartData['AgreedHours'] }}],
            }, {
                name: 'Price',
                data: [{{ $chartData['WorkedPrice'] }}, {{ $chartData['AgreedPrice'] }}],
            },
            ],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                        categories: ['Worked Progress','Agreed Progress']
            },
            // yaxis: {
            //     title: {
            //         text: '$ (thousands)'
            //     }
            // },
            fill: {
                opacity: 1
            },
            // tooltip: {
            //     y: {
            //         formatter: function (val) {
            //             return "$ " + val + " thousands"
            //         }
            //     }
           // }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        ClassicEditor
            .create(document.querySelector('#CK-description'))
            .catch(error => {
                console.error(error);
            });
        $('#customerId_edit').select2({
            dropdownParent: $('#projectEditFrom'),
        });

        {{--function getCustomers() {--}}
        {{--    $.ajax({--}}
        {{--        url: '/customers-tap-view/' + {{$project->id}},--}}
        {{--        type: 'GET',--}}
        {{--        success: function (data) {--}}
        {{--            $('.customerTap').empty().append(data)--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}

        // if ($('.button').className === "active"){
        //     getCustomers()
        //     console.log('has')
        // }
        // function getReload() {
        //     getCustomers()
        // }
function saveProject(){

    $('#submit').click()
}
        $('#projectEditFrom').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('edit-project-save',[$project->id])}}',
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    successMessage('Success', data.response);

                }
            })
        });

    </script>

@endsection
