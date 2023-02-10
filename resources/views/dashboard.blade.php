@extends('layouts.app')

@section('content')
{{--    <div id="key-canvas"></div>--}}
{{--    <script src="https://cdn.keysoftware.nl/template/custom/api/js/key-canvas.js" data-url="https://dev.keysoftware.nl/api/woningen/aanbod" async></script>--}}
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        @if($role->role == 'admin')
        <div class="modal fade" id="hourModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Fill Hours</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="hoursForm">
                            @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{ \Carbon\Carbon::today('Europe/Amsterdam')->format('Y-m-d') }}"
                                           aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                                    <input type="text" class="form-control" id="title" name="title"
                                           aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>

                            </div>
                            <div class="row">

                                <label for="floatingSelect">Select a Project</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" style="width: 100%;" name="project_id" id="project"
                                            aria-label="Floating label select example" class="browser-default">
                                        {{--                        <option selected>Open this select menu</option>--}}
                                        <option selected>Chose</option>
                                        @foreach(\App\Models\Project::all() as $project)
                                            <option value="{{$project->id}}">{{$project->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                                    <input type="time" class="form-control" id="time_from" name="time_from"
                                           aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">

                                    <span class="input-group-text" id="inputGroup-sizing-default">End Time</span>
                                    <input type="time" class="form-control" id="time_to" name="time_to"
                                           aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="col s12">
                                <textarea name="description" class="form-control" cols="50" rows="5"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <div class="modal fade" id="alertNotiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Alert Notification</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="notiForm">
                            @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                                    <input type="text" class="form-control" id="title" name="title"
                                           aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                                <div class="col s12">
                                    <textarea name="description" class="form-control" id="ck-noti" cols="50"
                                              rows="5"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
        @endif
        <div class="row">


            <div class="col-lg-8">
                <div class="row">
                    @if($role->role == 'admin')
                        <div class="d-flex justify-content-end mb-4 pull-center">
                            <div style="margin-right: 10px;">
                                <a onclick="alertNoti()" class="btn btn-primary">Alert Noti</a>
                            </div>

                            <a onclick="fillHours()" class="btn btn-primary">Add Hours</a>
                        </div>

                    @endif

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| Today</span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i></div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i></div>
                                    <div class="ps-3">

                                        <h6>{{$total}}</h6>
                                        {{--                                        <span class="text-success small pt-1 fw-bold">8%</span> <span--}}
                                        {{--                                            class="text-muted small pt-2 ps-1">increase</span>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                                {{--                                <form>--}}
                                {{--                                <select name="filter" id="filter" onchange="this.form.submit()">--}}
                                {{--                                    <option class="dropdown-item" value="{{[\Carbon\Carbon::today()->format('Y-m-d')]}}" {{\Carbon\Carbon::today()->format('Y-m-d') == request()->query('filter')? 'selected':''}}>Today</option>--}}
                                {{--                                    <option class="dropdown-item" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" {{\Carbon\Carbon::now()->format('m') == request()->query('filter')? 'selected':''}}>This Month</option>--}}
                                {{--                                    <option class="dropdown-item" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" {{\Carbon\Carbon::now()->format('Y') == request()->query('filter')? 'selected':''}}>This Year</option>--}}
                                {{--                                </select>--}}
                                {{--                                </form>--}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| This Year</span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i></div>
                                    <div class="ps-3">
                                        <h6>{{$customerAll->count()}}</h6>
                                        {{--                                        <span class="text-danger small pt-1 fw-bold">%</span> --}}
                                        {{--                                        <span--}}
                                        {{--                                            class="text-muted small pt-2 ps-1">decrease</span>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>
                                <div id="reportsChart"></div>
                                <script>

                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [
                                                //     {
                                                //     name: 'Sales',
                                                //     data: [31, 40, 28, 51, 42, 82, 56],
                                                // },
                                                {
                                                    name: 'Projects',
                                                    data: [
                                                        @foreach($p as $pd)
                                                                @if(\App\Models\Project::whereDate('created_at', \Carbon\Carbon::parse($pd))->count() > 0 || !\Carbon\Carbon::parse($pd)->isFuture())
                                                            "{{ \App\Models\Project::whereDate('created_at', \Carbon\Carbon::parse($pd))->count() }}",
                                                        @else
                                                            "",
                                                        @endif
                                                        @endforeach
                                                    ]
                                                },
                                                {
                                                    name: 'Customers',
                                                    data: [

                                                        @foreach($p as $pd)
                                                                @if(\App\Models\Customer::whereDate('created_at', \Carbon\Carbon::parse($pd))->count() > 0 || !\Carbon\Carbon::parse($pd)->isFuture())
                                                            "{{ \App\Models\Customer::whereDate('created_at', \Carbon\Carbon::parse($pd))->count() }}",
                                                        @else
                                                            "",
                                                        @endif
                                                        @endforeach


                                                    ]
                                                }
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: [@foreach($p as $pd)"{{$pd}}",@endforeach]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Recent Projects <span>| Today</span></h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($projectAll as $project)
                                        @php $cus = \App\Models\Customer::where('id',$project->customer_id)->first() @endphp
                                        @if($cus!= null)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$project->id}}</a></th>
                                                <td>
                                                    <a href="{{route('details',[$cus->id])}}">{{$cus->fullname ?? ''}}</a>
                                                </td>
                                                <td><a href="mailto:" class="text-primary">{{$cus->email ?? ''}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('details-project',[$project->id])}}">{{$project->title}}</a>
                                                </td>
                                                <td>
                                                    <span class="badge {{$project->status == 'pending' ? 'bg-warning' : ''}} {{$project->status == 'ready' ? 'bg-primary' : ''}} {{$project->status == 'delivered' ? 'bg-success' : ''}} {{$project->status == 'drop' ? 'bg-danger' : ''}}">{{$project->status}}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td>No information founded</td>
                                        </tr>
                                    @endforelse
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row"><a href="#">#2147</a></th>--}}
                                    {{--                                            <td>Bridie Kessler</td>--}}
                                    {{--                                            <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>--}}
                                    {{--                                            <td>$47</td>--}}
                                    {{--                                            <td><span class="badge bg-warning">Pending</span></td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row"><a href="#">#2049</a></th>--}}
                                    {{--                                            <td>Ashleigh Langosh</td>--}}
                                    {{--                                            <td><a href="#" class="text-primary">At recusandae consectetur</a></td>--}}
                                    {{--                                            <td>$147</td>--}}
                                    {{--                                            <td><span class="badge bg-success">Approved</span></td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row"><a href="#">#2644</a></th>--}}
                                    {{--                                            <td>Angus Grady</td>--}}
                                    {{--                                            <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>--}}
                                    {{--                                            <td>$67</td>--}}
                                    {{--                                            <td><span class="badge bg-danger">Rejected</span></td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row"><a href="#">#2644</a></th>--}}
                                    {{--                                            <td>Raheem Lehner</td>--}}
                                    {{--                                            <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>--}}
                                    {{--                                            <td>$165</td>--}}
                                    {{--                                            <td><span class="badge bg-success">Approved</span></td>--}}
                                    {{--                                        </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            {{--                                <div class="card-body pb-0">--}}
                            {{--                                    <h5 class="card-title">Top Selling <span>| Today</span></h5>--}}
                            {{--                                    <table class="table table-borderless">--}}
                            {{--                                        <thead>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="col">Preview</th>--}}
                            {{--                                            <th scope="col">Product</th>--}}
                            {{--                                            <th scope="col">Price</th>--}}
                            {{--                                            <th scope="col">Sold</th>--}}
                            {{--                                            <th scope="col">Revenue</th>--}}
                            {{--                                        </tr>--}}
                            {{--                                        </thead>--}}
                            {{--                                        <tbody>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>--}}
                            {{--                                            <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>--}}
                            {{--                                            <td>$64</td>--}}
                            {{--                                            <td class="fw-bold">124</td>--}}
                            {{--                                            <td>$5,828</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>--}}
                            {{--                                            <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>--}}
                            {{--                                            <td>$46</td>--}}
                            {{--                                            <td class="fw-bold">98</td>--}}
                            {{--                                            <td>$4,508</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>--}}
                            {{--                                            <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>--}}
                            {{--                                            <td>$59</td>--}}
                            {{--                                            <td class="fw-bold">74</td>--}}
                            {{--                                            <td>$4,366</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>--}}
                            {{--                                            <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>--}}
                            {{--                                            <td>$32</td>--}}
                            {{--                                            <td class="fw-bold">63</td>--}}
                            {{--                                            <td>$2,016</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                        <tr>--}}
                            {{--                                            <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>--}}
                            {{--                                            <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>--}}
                            {{--                                            <td>$79</td>--}}
                            {{--                                            <td class="fw-bold">41</td>--}}
                            {{--                                            <td>$3,239</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                        </tbody>--}}
                            {{--                                    </table>--}}
                            {{--                                </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                        <div class="activity">

                            @forelse($logBook as $log)
                                @php
                                    $start = \Carbon\Carbon::parse($log->created_at);
                                    $end = \Carbon\Carbon::now()->addMinutes(60);
                                   $parseEnd =  \Carbon\Carbon::parse($end);
                                    $subDays = $start->diff($parseEnd);
                $getProject = \App\Models\Project::find($log->id_of);
                $getAdmin = \App\Models\User::find($log->user_id)

                                @endphp
                                @if($log->created_at->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
                                    <div class="activity-item d-flex">
                                        <div class="activite-label">{{$log->created_at->format('H:i')}}</div>
                                        <i class='bi bi-circle-fill activity-badge {{$log->type == 'delete'? 'text-danger' : ''}}  {{$log->type == 'add'? 'text-success' : ''}} {{$log->type == 'filled'? 'text-primary' : ''}}  align-self-start'></i>
                                        <div class="activity-content">
                                            <strong>{{$getAdmin->name ?? ''}} </strong>{{$log->type}}
                                            <strong>{{ $getProject->title ?? '' }}</strong> {{$log->description}}</div>
                                    </div>
                                @endif
                            @empty
                                'No Information founded'
                            @endforelse

                            {{--                            <div class="activity-item d-flex">--}}
                            {{--                                <div class="activite-label">2 hrs</div>--}}
                            {{--                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>--}}
                            {{--                                <div class="activity-content"> Voluptates corrupti molestias voluptatem</div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="activity-item d-flex">--}}
                            {{--                                <div class="activite-label">1 day</div>--}}
                            {{--                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>--}}
                            {{--                                <div class="activity-content"> Tempore autem saepe <a href="#"--}}
                            {{--                                                                                      class="fw-bold text-dark">occaecati--}}
                            {{--                                        voluptatem</a> tempore--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="activity-item d-flex">--}}
                            {{--                                <div class="activite-label">2 days</div>--}}
                            {{--                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>--}}
                            {{--                                <div class="activity-content"> Est sit eum reiciendis exercitationem</div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="activity-item d-flex">--}}
                            {{--                                <div class="activite-label">4 weeks</div>--}}
                            {{--                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>--}}
                            {{--                                <div class="activity-content"> Dicta dolorem harum nulla eius. Ut quidem quidem sit--}}
                            {{--                                    quas--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>
                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                            name: 'Sales',
                                            max: 6500
                                        },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                                            name: 'Allocated Budget'
                                        },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>
                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                            value: 1048,
                                            name: 'Search Engine'
                                        },
                                            {
                                                value: 735,
                                                name: 'Direct'
                                            },
                                            {
                                                value: 580,
                                                name: 'Email'
                                            },
                                            {
                                                value: 484,
                                                name: 'Union Ads'
                                            },
                                            {
                                                value: 300,
                                                name: 'Video Ads'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>
                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos
                                    eius...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#ck-noti'))
            .catch(error => {
                console.error(error);
            });
        $('#project').select2({
            dropdownParent: $('#hoursForm'),
        });

        function alertNoti() {
            $('#alertNotiModal').modal('show');
        }

        function fillHours() {
            $('#hourModal').modal('show');
        }

        $('#hoursForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('hours-fill')}}',
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    successMessage('Success', data.response);
                    $('#hourModal').modal('toggle');
                }
            })
        });

        $('#notiForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('add-notification')}}',
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    successMessage('Success', data.response);
                    $('#alertNotiModal').modal('toggle');
                    getNoti()
                }
            })
        });

        {{--function changeTimeline() {--}}
        {{--    let month = $('#timelineMonth').val();--}}
        {{--    let year = $('#timelineYear').val();--}}

        {{--    $.get('/gebruikers/bekijken/<?php echo e($user->id); ?>/tijdlijn-aanpassen/' + month + '/' + year, function () {--}}
        {{--        loadNewPage('users.ajax.showPerformance')--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection
