@extends('layouts.app')
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Profile') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-profile-information-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-password-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
@section('content')
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <h2>Jassa</h2>
                    <h3>Web Designer</h3>
                    <div class="social-links mt-2"> <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> <a href="#" class="facebook"><i class="bi bi-facebook"></i></a> <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a></div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button></li>
                        <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button></li>
                        <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button></li>
                        <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button></li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
                            <h5 class="card-title">Profile Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{auth()->user()->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{auth()->user()->email}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8">Therichpost</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                <div class="col-lg-9 col-md-8">Web Designer</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8">USA</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8">Ludhiana, Punjab, India</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e982c788878d8c9b9a8687a98c91888499858cc78a8684">[email&#160;protected]</a></div>
                            </div>
                        </div>
                        @include('profile.partials.delete-user-form')
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                           @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-settings">
                            <form>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check"> <input class="form-check-input" type="checkbox" id="changesMade" checked> <label class="form-check-label" for="changesMade"> Changes made to your account </label></div>
                                        <div class="form-check"> <input class="form-check-input" type="checkbox" id="newProducts" checked> <label class="form-check-label" for="newProducts"> Information on new products and services </label></div>
                                        <div class="form-check"> <input class="form-check-input" type="checkbox" id="proOffers"> <label class="form-check-label" for="proOffers"> Marketing and promo offers </label></div>
                                        <div class="form-check"> <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled> <label class="form-check-label" for="securityNotify"> Security alerts </label></div>
                                    </div>
                                </div>
                                <div class="text-center"> <button type="submit" class="btn btn-primary">Save Changes</button></div>
                            </form>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change-password">
@include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
