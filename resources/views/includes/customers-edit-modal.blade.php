<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="editCustomerWrapper">
                    <form id="customerEditForm" class="row g-3">
                        <input type="hidden" id="cId">
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname_edit" id="inputName5">
                        </div>
                        <div class="col-md-6"><label for="inputEmail5" class="form-label">Email</label>
                            <input type="email" name="email_edit" class="form-control" id="inputEmail5"></div>
                        {{--            <div class="col-md-6"> <label for="inputPassword5" class="form-label">Password</label>--}}
                        {{--                <input type="password" class="form-control" id="inputPassword5"></div>--}}
                        {{--            <div class="col-12" id="customer_descr">--}}

                        {{--            </div>--}}

                        <div class="col-12"><label for="inputAddress5" class="form-label">Address</label>
                            <input type="text" name="adress_edit" class="form-control" id="inputAddres5s"
                                   placeholder="1234 Main St"></div>
                        <div class="col-12"><label for="inputAddress2" class="form-label">Address 2</label>
                            <input type="text" name="Secadress_edit" class="form-control" id="inputAddress2"
                                   placeholder="Apartment, studio, or floor"></div>
                        <div class="col-md-6"><label for="inputCity" class="form-label">City</label>
                            <input type="text" name="city_edit" class="form-control" id="inputCity"></div>
                        {{--            <div class="col-md-4">--}}
                        {{--                <label for="inputState" class="form-label">State</label>--}}
                        {{--                <select id="inputState" class="form-select">--}}
                        {{--                    <option selected>Choose...</option>--}}
                        {{--                    <option>...</option>--}}
                        {{--                </select>--}}
                        {{--            </div>--}}
                        <div class="col-md-3"><label for="inputZip" class="form-label">Zip</label>
                            <input type="text" name="zip_edit" class="form-control" id="inputZip"></div>
                        <div class="col-6">
                            <textarea class="form-control" name="description_edit" placeholder="Leave a comment here"
                                      id="description_edit" style="height: 100px"></textarea>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="deleteCustomer()" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

