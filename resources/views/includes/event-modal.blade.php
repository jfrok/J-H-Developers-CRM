    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    @csrf


                                <div class="row">

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                                        <input type="date" class="form-control" id="start" name="start" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                                        <input type="text" class="form-control" id="titley" name="title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                                        <input type="time" class="form-control" id="time_from" name="time_from" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                                        <span class="input-group-text" id="inputGroup-sizing-default">End Time</span>
                                        <input type="time" class="form-control" id="time_to" name="time_to" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>


                                </div>


                            <div class="col s12">

                                <input id="color" name="color" type="color" >
                                <label for="color">Color</label>

                            </div>






            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
