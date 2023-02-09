<div class="card">
    <div class="card-body">
        <h5 class="card-title">Customer Register</h5>
        <form id="customerForm" class="row g-3">
                <div class="col-md-12"> <label for="inputName5" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" id="inputName5"></div>
            <div class="col-md-6"> <label for="inputEmail5" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail5"></div>
{{--            <div class="col-md-6"> <label for="inputPassword5" class="form-label">Password</label>--}}
{{--                <input type="password" class="form-control" id="inputPassword5"></div>--}}
{{--            <div class="col-12" id="customer_descr">--}}

{{--            </div>--}}

            <div class="col-12"> <label for="inputAddress5" class="form-label">Address</label>
                <input type="text" name="adress" class="form-control" id="inputAddres5s" placeholder="1234 Main St"></div>
            <div class="col-12"> <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" name="Secadress" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"></div>
            <div class="col-md-6"> <label for="inputCity" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="inputCity"></div>
{{--            <div class="col-md-4">--}}
{{--                <label for="inputState" class="form-label">State</label>--}}
{{--                <select id="inputState" class="form-select">--}}
{{--                    <option selected>Choose...</option>--}}
{{--                    <option>...</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="col-md-2"> <label for="inputZip" class="form-label">Zip</label>
                <input type="text" name="zip" class="form-control" id="inputZip"></div>
            <div  class="col-6">
                <textarea class="form-control" name="description" id="textarea" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>

            </div>
                <div class="col-12">
                <div class="form-check"> <input class="form-check-input" type="checkbox" id="gridCheck"> <label class="form-check-label" for="gridCheck"> Check me out </label></div>
            </div>
            <div class="text-center"> <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
        </form>
    </div>
</div>
</div>

