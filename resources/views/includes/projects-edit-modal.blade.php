<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="editProjectWrapper">
                    <form id="projectEditForm" class="row g-3">
                        <input type="hidden" id="pId">
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Title</label>
                            <input type="text" class="form-control" name="edit_title" id="inputName5">
                        </div>

                        <div class="row">
                            {{--@php($selectedCustomer = \App\Models\Customer::find($project->customer_id))--}}
                            <label for="floatingSelect">Select a Customer</label>
                            <div class="input-group mb-3" >
                                {{--                                {{dd($project)}}--}}
                                <select class="form-select" style="width: 100%;" name="customer_id" id="customer_edit" aria-label="Floating label select example" class="browser-default">
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"><label for="inputCity" class="form-label">Set Hours</label>
                            <input type="number" name="set_hours" class="form-control" id="inputCity"></div>

                        <div class="col-md-4"><label for="inputZip" class="form-label">Set Price</label>
                            <input type="number" name="set_price" class="form-control" id="inputZip"></div>
                        <div class="col-6">
                            <textarea class="form-control" name="description_edit" placeholder="Leave a comment here"
                                      id="description_edit" style="height: 100px;width: 300px"></textarea>

                        </div>
                        <input type="hidden" name="status">
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select class="form-select" id="floatingSelect" name="status"--}}
{{--                                    aria-label="Floating label select example">--}}
{{--                                <option value="pending" {{$project->status == 'pending' ? 'selected' : ''}}>Pending</option>--}}
{{--                                <option value="ready" {{$project->status == 'ready' ? 'selected' : ''}}>Ready</option>--}}
{{--                                <option value="delivered" {{$project->status == 'delivered' ? 'selected' : ''}}>Delivered</option>--}}
{{--                                <option value="drop" {{$project->status == 'drop' ? 'selected' : ''}}>Drop</option>--}}
{{--                            </select>--}}
{{--                            <label for="floatingSelect">Works with selects</label>--}}
{{--                        </div>--}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="deleteProject()" class="btn btn-danger">Delete</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

