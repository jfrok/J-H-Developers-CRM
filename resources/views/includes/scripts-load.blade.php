<div class="row">
        <div class="logo">
            <h1>J&H</h1>
        </div>
        @forelse($scripts as $script)

                <div class="border border-b-2">
            <p class="lh-1">
                {!!$script->description!!}
            </p>
                    <a onclick="deleteScripts({{$script->id}})" class="btn btn-danger">Delete</a>
                </div>
        @empty

        @endforelse
        <div class="row">
            <form id="scriptForm">
                @csrf
                <div class="col-md-4 titleHide" style="display: none">
                    <label for="inputZip" class="form-label">Title</label>
                    <input type="hidden" class="form-control" value="{{$page->id}}" name="pageId">
                    <input type="text" class="form-control" name="title">
                </div>
                <label for="inputZip" class="form-label">Description</label>

                <textarea name="description" id="description-editor" cols="30" rows="10"></textarea>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

</div>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description-editor'))
        .catch(error => {
            console.error(error);
        });

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
