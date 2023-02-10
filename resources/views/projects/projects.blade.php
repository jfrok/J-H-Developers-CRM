@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Add A Project</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Editors</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Project</h5>
            <form id="projectForm" class="row g-3">
                <div class="col-md-12"> <label for="inputName5" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="inputName5"></div>
{{--                <div class="col-md-6"> <label for="inputEmail5" class="form-label">Customer</label>--}}
{{--                    <input type="email" name="email" class="form-control" id="inputEmail5"></div>--}}
{{--                <div class="form-floating">--}}


{{--                <label for="customer">Select a Customer</label>--}}
{{--                <select name="customer" id="customer" class="browser-default">--}}

{{--                        <option value="">test</option>--}}

{{--                </select>--}}
{{--                </div>--}}
                <label for="floatingSelect">Select a Customer</label>

                <div class="form-floating">
                    <select  name="customer_id" id="customer"  class="browser-default">
{{--                        <option selected>Open this select menu</option>--}}
                        <option selected>Chose</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Set Hours</label>
                    <input type="number" name="set_hours" class="form-control" id="inputZip" required>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Set Price</label>
                    <input type="number" name="set_price" class="form-control" id="inputZip" required>
                </div>
                <div class="row" style="margin-top: 15px">
{{--                <div class="row">--}}
{{--                <div class="col-md-6"> <label for="inputCity" class="form-label">Status</label>--}}
{{--                    <input type="text" name="city" class="form-control" id="inputCity"></div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <label for="inputState" class="form-label">State</label>--}}
{{--                                <select id="inputState" class="form-select">--}}
{{--                                    <option selected>Choose...</option>--}}
{{--                                    <option>...</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                </div>--}}


                    <textarea class="form-control" name="description" id="description" placeholder="Leave a comment here"  style="height: 100px"></textarea>

                </div>
                <div class="col-12">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" id="gridCheck"> <label class="form-check-label" for="gridCheck"> Accepted all conditions </label></div>
                </div>
                <div class="text-center"> <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
            </form>
        </div>
    </div>
    </div>


@endsection
@section('scripts')

    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
       // CKEDITOR.replace('editor1')

       $('#customer').select2({
           dropdownParent: $('.card-body'),
       });
    </script>
    <script>

        $('#projectForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('add-project')}}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {

                    // renderCalendar();
                    successMessage('Success', data.response);

                    $('input[name="title"]').val('')
                    $('input[name="set_hours"]').val('')
                    // $('#textarea').val('')
                    $('input[name="set_price"]').val('')
                    $('#description').val('')
                    $('#gridCheck').val('')
                }
            })
        });
    </script>

@endsection
