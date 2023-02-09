    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Hours</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="hourEditForm">
                    <input type="hidden" id="hId" value="">
                    @csrf
                    <div class="row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                            <input type="date" class="form-control" id="date" name="date_edit" value="{{ \Carbon\Carbon::today('Europe/Amsterdam')->format('Y-m-d') }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                            <input type="text" class="form-control" id="title" name="title_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                            <input type="time" class="form-control" id="time_from" name="time_from_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                            <span class="input-group-text" id="inputGroup-sizing-default">End Time</span>
                            <input type="time" class="form-control" id="time_to" name="time_to_edit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col s12" >
                        <textarea name="description_edit" id="descr" class="form-control" cols="50" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteHour()" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

