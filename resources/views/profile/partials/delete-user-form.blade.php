
{{--    <x-danger-button--}}
{{--        x-data=""--}}
{{--        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"--}}
{{--    >{{ __('Delete Account') }}</x-danger-button>--}}

{{--    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>--}}
{{--        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">--}}
{{--            @csrf--}}
{{--            @method('delete')--}}

{{--            <h2 class="text-lg font-medium text-gray-900">Are you sure your want to delete your account?</h2>--}}



{{--            <div class="mt-6">--}}
{{--                <x-input-label for="password" value="Password" class="sr-only" />--}}

{{--                <x-text-input--}}
{{--                    id="password"--}}
{{--                    name="password"--}}
{{--                    type="password"--}}
{{--                    class="mt-1 block w-3/4"--}}
{{--                    placeholder="Password"--}}
{{--                />--}}

{{--                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <div class="mt-6 flex justify-end">--}}
{{--                <x-secondary-button x-on:click="$dispatch('close')">--}}
{{--                    {{ __('Cancel') }}--}}
{{--                </x-secondary-button>--}}

{{--                <x-danger-button class="ml-3">--}}
{{--                    {{ __('Delete Account') }}--}}
{{--                </x-danger-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-modal>--}}
    <!-- Modal -->
    <div class="modal fade" id="deleteUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter your password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="password">
                        @if($errors->has('password'))
                            {{$errors->first('password')}}
                        @endif
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
