
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img src="assets/img/profile-img.jpg" alt="Profile">
                <div class="pt-2">
                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image">
                        <i class="bi bi-upload"></i>
                    </a>

                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Remove my profile image">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name" value="{{auth()->user()->name}}">
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="text" class="form-control" id="email" value="{{auth()->user()->email}}">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" onclick="deleteUser()" class="btn btn-danger">Delete Account!</button>

        </div>
    </form>
    <script>
        function deleteUser(){
            $('#deleteUserModal').modal('show')
        }
    </script>
