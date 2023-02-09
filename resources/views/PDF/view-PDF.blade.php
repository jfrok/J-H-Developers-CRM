@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-title">
        </div>
        <div class="card-body">
{{--            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">--}}
{{--                <li class="nav-item" role="presentation">--}}
{{--                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"--}}
{{--                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"--}}
{{--                            aria-selected="true">Home--}}
{{--                    </button>--}}
{{--                </li>--}}

{{--                @foreach($views as $view)--}}
{{--                    <from method="post">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="page_id">--}}
{{--                        <button type="submit" id="pageBtn"></button>--}}
{{--                    </from>--}}
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"--}}
{{--                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"--}}
{{--                                aria-selected="false">{{$view->title}}--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                @endforeach--}}

{{--            </ul>--}}
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                     tabindex="0">
                    <div style="display: flex; justify-content: end">
                        <div class="d-block">
                            <div class="d-flex justify-content-end mb-4 pull-center">
                                <a onclick="pdfScript()" class="btn btn-primary">Export PDF</a>
                            </div>
{{--                            <div class="form-check form-switch">--}}
{{--                                <input class="form-check-input" type="checkbox" role="switch"--}}
{{--                                       id="flexSwitchCheckDefault">--}}
{{--                                <label class="form-check-label" for="flexSwitchCheckDefault">Logo</label>--}}
{{--                            </div>--}}
{{--                            --}}{{--                            onchange="setTimeInputs($(this).parent())"--}}
{{--                            --}}{{--                            <div class="form-check">--}}
{{--                            --}}{{--                                <input class="form-check-input" name="titleC" type="checkbox" onchange="setTimeInputs($(this).parent())"  id="title">--}}
{{--                            --}}{{--                                <label class="form-check-label" for="defaultCheck1">--}}
{{--                            --}}{{--                                    Title--}}
{{--                            --}}{{--                                </label>--}}
{{--                            --}}{{--                            </div>--}}
{{--                            <div class="form-check form-switch">--}}
{{--                                <input class="form-check-input" name="titleC" onchange="SetTitle($(this).parent())"--}}
{{--                                       type="checkbox" role="switch"--}}
{{--                                       id="flexSwitchCheckDefault">--}}
{{--                                <label class="form-check-label" for="flexSwitchCheckDefault">Title</label>--}}

{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="reload-scripts">
                        @include('includes.scripts-load')
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                     tabindex="0">...
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                     tabindex="0">...
                </div>
                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab"
                     tabindex="0">...
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function SetTitle() {
            if ($('input[name="titleC"]').is(':checked')) {
                $('.titleHide').removeAttr('style');
                //  wrapper.find('input[name="title"]').attr('required', true);
            } else {
                $('.titleHide').css("display", "none");
                // wrapper.find('input[name="title"]').removeAttr('required');
            }
        }
        function pdfScript()
        {
            window.open('{{route('create-scripts',[$page->id])}}', '_blank')
        }
        function getScripts()
        {
            $.ajax({
                url:'/customers/view-scripts/{{$page->id}}',
                type: 'GET',
                success: function (data){
                    $('.reload-scripts').empty().append(data)
                }
            })
        }

    function deleteScripts(sId) {
        // const scriptsId = document.getElementById('hId').value
        Swal.fire({
            icon: "warning",
            title: "Delete This?",
            text: "Are you sure you want to delete this text",
            confirmButtonText: "Yes",
            confirmButtonColor: "red",
            showCancelButton: true,
            cancelButtonText: "Close",
        }).then((result) => {
            if (result.isConfirmed) {

                $.get('/customers/scripts-deleted/' + sId, function (data) {
                 //   $('#editScriptsModal').modal('toggle')
                    getScripts()
                })
            }
        })
}
        $('#scriptForm').on('submit', function (e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: '{{route('add-scripts')}}',
                method:'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data){
                    getScripts()
                    // $('#description-editor').val = '';
                    successMessage('Success', data.response);
                }
            })
        });
    </script>
@endsection
