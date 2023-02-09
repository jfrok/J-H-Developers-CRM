
<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')
    <div class="row mb-3">
        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="current_password" type="password" class="form-control" id="current_password">
            @if($errors->has('current_password'))
                {{$errors->first('current_password')}}
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="password" type="password" class="form-control" id="password">
            @if($errors->has('password'))
                {{$errors->first('password')}}
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
            @if($errors->has('password_confirmation'))
                {{$errors->first('password_confirmation')}}
            @endif
        </div>
    </div>
    <div class="flex items-center gap-4">

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Change Password</button></div>
    @if (session('status') === 'password-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        >{{ __('Saved.') }}</p>
    @endif
</form>
