@extends('layouts.app')
@section('content')



    <div class="pagetitle">
        <h1>Projects Overview</h1>
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
                        @include('includes.projects-edit-modal')
                        <h5 class="card-title">Projects</h5>
                        <div class="getProjects">
                       @include('includes.projects-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--            <iframe src="http://localhost:8000/generate-pdf-view?download=pdf" frameborder="0" width="100%" height="100%"></iframe>--}}
        </section>
@endsection
@section('scripts')
    <script>

        $('#customer_edit').select2({
            dropdownParent: $('#editProjectModal'),
        });
        $(document).ready(function() {
            $(document).on('click', '.editBtn', function () {
                var pId = $(this).val();
                $('#editProjectModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/project-edit/"+pId,
                    success: function (response) {
                        console.log(response)
                        $("#pId").val(response.project.id)
                        $('input[name="edit_title"]').val(response.project.title)
                        $('#description_edit').val(response.project.description)
                        $('#customerId_edit').val(response.project.customer_id)
                        $('input[name="set_hours"]').val(response.project.set_hours)
                        $('input[name="set_price"]').val(response.project.set_price)
                        $('input[name="status"]').val(response.project.status)
                    }
                })
            })
        })


        function getProjectRequest()
        {
            $.ajax({
                url:'/projects/request',
                type: 'GET',
                success: function (data){
                    $('.getProjects').empty().append(data)
                }
            })
        }

        $('#projectEditForm').on('submit', function (e) {
            const pId =  document.getElementById('pId').value
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/project-edit-save/"+pId,
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {

                    getProjectRequest()
                    $('#editProjectModal').modal('toggle')
                    successMessage('Success', data.response);

                }
            })
        });

        function deleteProject(pId) {
            const projectId =  document.getElementById('pId').value
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

                    $.get('/project-deleted/' + projectId, function (data) {
                        $('#editProjectModal').modal('toggle')
                        getProjectRequest()                    })
                }
            })
        }

    </script>
@endsection
