@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Trash</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>


    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Deleted at</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($customerTrash as $trash)
                                {{--                    @php($customerName = \App\Models\Customer::find($project->customer_id))--}}
                                <tr>
                                    <th scope="row">1</th>

                                    <td>{{$trash->fullname}}</td>
                                    <td>{{$trash->email}}</td>
                                    {{--            <td>{{$project->city}}</td>--}}
                                    <td>{{\Carbon\Carbon::parse($trash->created_at)->format('d-F-Y')}}</td>
                                    <td>
                                        <form method="post" action="{{route('restore',$trash->id)}}">
                                            @csrf
                                            <button type="submit" class="editBtn btn btn-primary"
                                                    value="{{$trash->id}}"><i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('forceDelete',[$trash->id])}}">
                                            @csrf
                                            <button type="button" id="prD" class="editBtn btn btn-danger"
                                                    onclick="prDelete({{$trash->id}})"><i
                                                    class="bi bi-x-circle-fill"></i></button>
                                            <button style="display: none" type="submit" id="action" class="editBtn btn btn-danger"
                                                    value="{{$trash->id}}">
                                                <i class="bi bi-x-circle-fill"></i></button>
                                        </form>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($trash->deleted_at)->format('d-F-Y')}}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td>There is no information</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Deleted at</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($projectTrash as $trash)
                                @php($customerName = \App\Models\Customer::find($trash->customer_id))
                                <tr>
                                    <th scope="row">1</th>

                                    <td>{{$trash->title}}</td>
                                    <td>
                                        {{ $customerName->fullname ?? '' }}
                                    </td>
                                    {{--            <td>{{$project->email}}</td>--}}
                                    {{--            <td>{{$project->city}}</td>--}}
                                    <td>{{\Carbon\Carbon::parse($trash->created_at)->format('d-F-Y')}}</td>
                                    <td>
                                        <form method="post" action="{{route('restore',$trash->customer_id)}}">
                                            @csrf
                                            <button type="submit" class="editBtn btn btn-primary"
                                                    value="{{$trash->customer_id}}"><i
                                                    class="bi bi-arrow-counterclockwise"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('forceDelete',[$trash->customer_id])}}">
                                            @csrf
                                            <button type="button" class="editBtn btn btn-danger"
                                                    onclick="prPDelete()">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </button>
                                            <button style="display: none" type="submit" id="actionP" class="editBtn btn btn-danger"
                                                    value="{{$trash->id}}">
                                                <i class="bi bi-x-circle-fill"></i></button>
                                        </form>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($trash->deleted_at)->format('d-F-Y')}}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td>There is no information</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function prDelete() {
            Swal.fire({
                icon: "warning",
                title: "Delete Customer?",
                text: "Are you sure you want to delete this customer permanently",
                confirmButtonText: "Yes",
                confirmButtonColor: "red",
                showCancelButton: true,
                cancelButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#action').click()
                }
            })
        }
        function prPDelete() {
            Swal.fire({
                icon: "warning",
                title: "Delete Project?",
                text: "Are you sure you want to delete this project permanently",
                confirmButtonText: "Yes",
                confirmButtonColor: "red",
                showCancelButton: true,
                cancelButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#actionP').click()
                }
            })
        }
    </script>
@endsection
