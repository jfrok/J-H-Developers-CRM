@extends('layouts.app')
@section('content')



    <div class="pagetitle">
        <h1>Customers Overview</h1>
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

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('includes.customers-edit-modal')
                        <h5 class="card-title">Customers</h5>
{{--                        <div class="getCustomers">--}}

                        <div  style="display: flex;justify-content: end">

                            <input type="text" name="searchQuery" id="searchQuery"
                                   placeholder="Search"
                                   title="Enter search keyword" onkeyup="searchCustomers()">
                            {{--        <button type="submit" title="Search"><i class="bi bi-search"></i></button>--}}

                        </div>
                        <div id="getCustomers">
                            <a onclick="getCustomers()"></a>
                        @include('includes.customers-table')
                        </div>
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

{{--            <iframe src="http://localhost:8000/generate-pdf-view?download=pdf" frameborder="0" width="100%" height="100%"></iframe>--}}


        </section>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection
@section('scripts')
    <script>


        $(document).ready(function() {
            $(document).on('click', '.editBtn', function () {
                var custmId = $(this).val();
                $('#editCustomerModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/customers/customers-edit/"+custmId,
                    success: function (response) {
                        console.log(response)
                        $("#cId").val(response.customer.id)
                        $('input[name="fullname_edit"]').val(response.customer.fullname)
                        $('input[name="email_edit"]').val(response.customer.email)
                        $('input[name="adress_edit"]').val(response.customer.address)
                        $('input[name="Secadress_edit"]').val(response.customer.address_sec)
                        $('input[name="city_edit"]').val(response.customer.city)
                        $('input[name="zip_edit"]').val(response.customer.zip)
                        $('#description_edit').val(response.customer.description)
                    }
                })
            })
        })


        function getCustomers()
        {
            $.ajax({
                url:'/customers/view',
                type: 'GET',
                success: function (data){
                    $('#getCustomers').empty().append(data)
                }
            })
        }

        $('#customerEditForm').on('submit', function (e) {
            const customerId =  document.getElementById('cId').value
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/customers/customers-edit-save/"+customerId,
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {

                    getCustomers()
                    $('#editCustomerModal').modal('toggle')
                    successMessage('Success', data.response);

                }
            })
        });

        function deleteCustomer(cId) {
            const customerId =  document.getElementById('cId').value
            Swal.fire({
                icon: "warning",
                title: "Delete Customer?",
                text: "Are you sure you want to delete this customer",
                confirmButtonText: "Yes",
                confirmButtonColor: "red",
                showCancelButton: true,
                cancelButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {

                    $.get('/customers/customer-deleted/' + customerId, function (data) {
                        $('#editCustomerModal').modal('toggle')
                        getCustomers()
                    })
                }
            })
        }


        function searchCustomers() {
            let searchQuery = $('#searchQuery').val();
            $.get('/customers/search', {
                searchQuery: searchQuery,

            }, function (data) {
                $('#getCustomers').empty().append(data);
            });
        }
    </script>
@endsection
