<?php
$currentPage = 'staffRegisterPage';
$currentNav = 'staff';
?>

@include('admin.include.header')


<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>
                @if (@$staffDetail)
                    Update
                @else
                    Add
                @endif
                staff
                <i class="fa-solid fa-cart-plus"></i>
            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form
                    action="{{ @$staffDetail ? route('admin.updateStaff', $staffDetail->id) : route('admin.staffRegister') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Full Name :</label>
                            </div>
                            <input type="text" placeholder="Enter Your Full Name" name="name"
                                value="@if(@$staffDetail){{ $staffDetail->name }}@else{{ old('name') }}@endif">

                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Phone Number :</label>
                            </div>
                            <input type="text" placeholder="Enter Phone Number" name="contact_number"
                                value="@if (@$staffDetail) {{ $staffDetail->contact_number }}@else{{ old('contact_number') }}@endif">
                            @error('contact_number')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Email :</label>
                            </div>
                            <input type="text" placeholder="Enter Email" name="email"
                                value="@if (@$staffDetail) {{ $staffDetail->email }}@else{{ old('email') }}@endif">
                            @error('email')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Password" name="password">
                            @error('password')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Confirm Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Confirm Password" name="conform_password">
                            @error('conform_password')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <button class="add-items">
                        Add Staff
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
