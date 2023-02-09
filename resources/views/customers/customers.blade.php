@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Register A Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Editors</li>
            </ol>
        </nav>
    </div>

@include('includes.customers-form')
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
       // CKEDITOR.replace('editor1')


    </script>
    <script>

        $('#customerForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('add-customer')}}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {

                    // renderCalendar();
                    successMessage('Success', data.response);

                    $('input[name="fullname"]').val('')
                    $('input[name="email"]').val('')
                    $('#textarea').val('')
                    $('input[name="adress"]').val('')
                    $('input[name="Secadress"]').val('')
                    $('input[name="city"]').val('')
                    $('input[name="zip"]').val('')
                }
            })
        });
    </script>

@endsection
