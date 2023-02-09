@extends('layouts.app')
@section('content')
    <div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create page</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="pageForm">
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
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
{{--            <div class="container text-center">--}}
               <div id="load-pages">

                   @include('PDF.includes.pages-load')
               </div>
{{--                </div>--}}

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openPage()
        {
            $('#pageModal').modal('show')
        }
        function getPdfPage()
        {
            $.ajax({
                url:'/customers/load-page',
                type: 'GET',
                success: function (data){
                    $('#load-pages').empty().append(data)
                }
            })
        }
        $('#pageForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('create-page')}}',
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    successMessage('Success', data.response);
                    $('#pageModal').modal('toggle');
                    getPdfPage()
                }
            })
        });
        function deletePage(pId) {
            // const scriptsId = document.getElementById('hId').value
            Swal.fire({
                icon: "warning",
                title: "Delete page?",
                text: "Are you sure you want to delete this page",
                confirmButtonText: "Yes",
                confirmButtonColor: "red",
                showCancelButton: true,
                cancelButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {

                    $.get('/customers/delete-page/' + pId, function (data) {
                        getPdfPage()
                    })
                }
            })
        }
    </script>

    @endsection
