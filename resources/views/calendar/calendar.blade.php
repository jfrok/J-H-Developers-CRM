@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Calendar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Editors</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            @include('includes.event-modal')
        </div>
        <div class="modal fade" id="eventEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            @include('includes.event-edit-modal')
        </div>
        <div class="d-grid gap-3">
        <div class="card">
            <div class="card-header">
                Schedule
            </div>
                <div class="card-body">
                    <div id="calenderView">
                    @include('includes.event-calendar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            renderCalendar();
        });
        function getEvents() {
            $.ajax({
                url: "/event-calendar",
                method: "GET",
                success: function (data) {
                    $('#calenderView').empty().append(data);
                    renderCalendar();
                },
                error: function (data) {

                }
            })
        }
        function refreshCalendar() {
            // renderCalendar();
            getEvents()
        }
        $('#eventForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('addEvent') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    getEvents()
                    $('#eventModal').modal('toggle');
                    successMessage()
                },
            })
        });

        $('#eventEditForm').on('submit', function (e) {
            const eventId = document.getElementById('id').value
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/calendar-event-edited/" + eventId,
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    getEvents()
                    $('#eventEditModal').modal('toggle');
                    // renderCalendar();
                    successMessage('success', data.response);

                },
                error: function (data) {
                    // alert('error:' + data.response);
                   // errorMessage('error', + data.response);
                }
            })
        });

    </script>
@endsection
