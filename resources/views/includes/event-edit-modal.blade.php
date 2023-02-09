<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add event</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="eventEditForm">
                @csrf

                <input type="hidden" id="id" value="">
                <div class="row">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                        <input type="date" class="form-control" id="start_edit" name="start_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                        <input type="text" class="form-control" id="title_edit" name="title_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                        <input type="time" class="form-control" id="time_from_edit" name="time_from_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                        <span class="input-group-text" id="inputGroup-sizing-default">End Time</span>
                        <input type="time" class="form-control" id="time_to_edit" name="time_to_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>


                </div>


                <div class="col s12">

                    <input id="color_edit" name="color_edit" type="color" >
                    <label for="color">Color</label>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteEvent()" class="btn btn-danger">Delete</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    function deleteEvent(eId) {
        const eventId =  document.getElementById('id').value
        Swal.fire({
            icon: "warning",
            title: "Event verwijderen?",
            text: "Weet je zeker dat je deze event wilt verwijderen?",
            confirmButtonText: "Ja",
            confirmButtonColor: "red",
            showCancelButton: true,
            cancelButtonText: "Sluiten",
        }).then((result) => {
            if (result.isConfirmed) {

                $.get('/event-deleted/' + eventId, function (data) {
                    getEvents()
                     $('#eventEditModal').modal('toggle')
                })
            }
        })
    }
</script>
