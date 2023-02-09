<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<div class="tab-content " id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
         aria-labelledby="v-pills-home-tab">
        <div class="d-flex justify-content-end mb-4 pull-center">
            <a onclick="pdf()" class="btn btn-primary">Export PDF</a>
        </div>
        <div class="container">
        <div class="row">
        {{$customers->description}}
        </div>
            <hr>
            <h4>Messages</h4>
            <hr>
            <div class="row" style="height: auto; overflow-y: scroll; max-height: 500px">

            @forelse($messages as $message)

{{--                    {{\Carbon\Carbon::parse(date($message->created_at))->format('d-F-Y')}}--}}
                    {{date($message->created_at)}}
                    <br>
                    {{$message->subject}}
                    <br>
                {!! $message->message !!}
                    <hr>
          @empty
              <h4>No contact</h4>
          @endforelse
      </div>
    </div>
    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
         aria-labelledby="v-pills-profile-tab">
        <h5 class="card-title">Edit Customer</h5>
        <form class="row g-3" id="editCutsomersDetails">
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" name="fullname_edit" value="{{$customers->fullname}}" id="fullname" placeholder="Full Name">
                    <label for="floatingName">Full Name</label></div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control" name="email_edit" value="{{$customers->email}}" id="floatingEmail" placeholder="Email">
                    <label for="floatingEmail">Email</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingCity" name="city_edit" value="{{$customers->city}}" placeholder="City">
                        <label for="floatingCity">City</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="inputAddress5" class="form-label">Address / Sec</label>
                <input type="text" name="adress_edit" value="{{$customers->address}}" class="form-control" id="inputAddres5s"
                       placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <input type="text" name="Secadress_edit" value="{{$customers->address_sec}}" class="form-control" id="inputAddress2"
                       placeholder="Apartment, studio, or floor"></div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="text" class="form-control" name="zip_edit" value="{{$customers->zip}}" id="floatingZip" placeholder="Zip">
                    <label for="floatingZip">Zip</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" name="description_edit"  placeholder="Description" id="floatingTextarea" style="height: 100px;">{{$customers->description}}</textarea>
                    <label for="floatingTextarea">Description</label>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button></div>
        </form>
    </div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
         aria-labelledby="v-pills-messages-tab">
        <div class="row">
        <form id="sendMessagesForm">
            @csrf
            <label for="floatingTextarea">The Subject</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="subject" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">

            <input type="hidden" name="customerId" value="{{$customers->id}}">
                <div class="col s12">
            <label for="floatingTextarea">The Message</label>
            <textarea name="message" id="CK-messages"></textarea>
            </div>

            </div>
            <div class="row p-2">
            <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
        </div>


</div>
</div>
<script>
    function pdf()
    {
        window.open('{{route('PDF-generator',[$customers->id])}}', '_blank')
    }
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#CK-messages' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    $('#sendMessagesForm').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: '{{route('send-message')}}',
            method:'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (data){
                successMessage('Success', data.response);
                getCustomers()
            }
        })
    });
CKEDITOR.replace('CK-messages');

$('#editCutsomersDetails').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: '{{route('edit-customer-save',[$customers->id])}}',
            method:'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (data){
                successMessage('Success', data.response);

            }
        })
    });

</script>
