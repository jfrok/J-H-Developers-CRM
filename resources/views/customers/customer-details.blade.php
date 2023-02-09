@extends('layouts.app')
@section('content')
    <style>
        .listBtns .nav button {
            margin-top: 30%;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Details</h5>
                    <div class="d-flex align-items-start">
                        <div class="listBtns">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">

                                <button class="nav-link active button" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-home" type="button" role="tab"
                                        aria-controls="v-pills-home"
                                        aria-selected="true" onclick="getCustomers()">Overview
                                </button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-profile" type="button" role="tab"
                                        aria-controls="v-pills-profile" aria-selected="false">Edit
                                </button>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-messages" type="button" role="tab"
                                        aria-controls="v-pills-messages" aria-selected="false">Messages
                                </button>
                            </div>
                        </div>
                        <div class="customerTap">
                            @include('includes.customer-tab')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script>
        function getCustomers() {
            $.ajax({
                url: '/customers/customers-tap-view/' + {{$customers->id}},
                type: 'GET',
                success: function (data) {
                    $('.customerTap').empty().append(data)
                }
            })
        }

        // if ($('.button').className === "active"){
        //     getCustomers()
        //     console.log('has')
        // }
        function getReload() {
            getCustomers()
        }

        $('#editCutsomersDetails').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('edit-customer-save',[$customers->id])}}',
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    successMessage('Success', data.response);

                }
            })
        });
        $('#sendMessagesForm').on('submit', function (e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('send-message')}}',
                method:'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data){
                    successMessage('Success', data.response);
                    getCustomers()
                }
            })
        });
    </script>
@endsection
