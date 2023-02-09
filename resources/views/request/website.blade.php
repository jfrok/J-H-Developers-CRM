@extends('layouts.guest')
@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Website form</h5>
            @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <form action="{{route('request.create')}}" method="POST" enctype="multipart/form-data">
@csrf
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="first_name" id="floatingPassword" value="{{old('first_name')}}" placeholder="First name">
                        <label for="floatingFirstName">First name</label>
                        @if($errors->has('first_name'))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first("first_name")}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="last_name" id="floatingLastName" value="{{old('last_name')}}"  placeholder="Last name" required>
                        <label for="floatingLastName">Last name</label>
                        @if($errors->has('last_name'))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first("last_name")}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="company_name" id="floatingInput" value="{{old('company_name')}}" placeholder="name@example.com">
                        <label for="floatingInput">Company name! optional</label></div>
                </div>

            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" value="{{old('email')}}" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                @if($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first("email")}}
                    </div>
                @endif
            </div>
        <div class="row mb-3" style="padding: 20px 30px">
            <div class="col mb-4">
                <h3>Explain how we can help you </h3>
                <textarea name="details" id="details-ck" value="{{old('details')}}" cols="30" rows="10" required></textarea>
            </div>
            @if($errors->has('details'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first("details")}}
                </div>
            @endif
            <div class="mb-4">
                <label for="formFileLg" class="form-label">Chose a file</label>
                <input class="form-control form-control-lg" id="formFileLg" name="file"  type="file">
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>

        </div>
        </form>

{{--        <form action="{{route('request.drop')}}" method="POST" enctype="multipart/form-data" id="my-form" class="dropzone">--}}
{{--            @csrf--}}
{{--        </form>--}}
        </div>



    </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

    <script type="text/javascript">

        ClassicEditor
            .create(document.querySelector('#details-ck'))
            .catch(error => {
                console.error(error);
            });
// $("#button").click(function (){
//     let myDropzone = new Dropzone("#my-form", {
//         thumbnailWidth: 200,
//         maxFilesize: 1,
//         acceptedFiles: ".jpeg,.jpg,.png,.gift"
//     });
// })

    </script>
@endsection
