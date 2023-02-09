@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Hours Overview</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <div class="modal fade" id="editHourModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        @include('includes.edit-hour-modal')
    </div>

    <div class="reload">
        @include('work.includes.get-hours')
    </div>
    {{--    <button onclick="getHours()">test</button>--}}

@endsection
@section('scripts')
    <script>
        function getHours() {
            $.ajax({
                url: '/get-hours',
                type: 'GET',
                success: function (data) {
                    $('.reload').empty().append(data)
                }
            })
        }

        $(document).ready(function () {
            $(document).on('click', '.editHourBtn', function () {
                var huorId = $(this).val();
                $('#editHourModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/hour-edit/" + huorId,
                    success: function (response) {
                        console.log(response)
                        $("#hId").val(response.hour.id)
                        $('input[name="date_edit"]').val(response.hour.date)
                        $('input[name="time_from_edit"]').val(response.hour.time_from)
                        $('input[name="time_to_edit"]').val(response.hour.time_to)
                        $('input[name="title_edit"]').val(response.hour.title)
                        $('#descr').val(response.hour.description);
                    }
                })
            })
        })

        function deleteHour(hId) {
            const hourId = document.getElementById('hId').value
            Swal.fire({
                icon: "warning",
                title: "Delete This?",
                text: "Are you sure you want to delete this",
                confirmButtonText: "Yes",
                confirmButtonColor: "red",
                showCancelButton: true,
                cancelButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {

                    $.get('/hour-deleted/' + hourId, function (data) {
                        $('#editHourModal').modal('toggle')
                        getHours()
                    })
                }
            })
        }
    </script>

@endsection
