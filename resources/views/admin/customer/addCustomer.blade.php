<?php
$currentPage = 'CustomerFormPage';
$currentDiv = 'customer';
?>

@include('admin.include.header')
<style>
    .error {
        color: red;
    }

    .sweetErrormessage {
        position: fixed;
        height: 70px;
        top: 30px;
        right: 10px;
        background-color: #ff0000 !important;
        color: white;
        padding: 25px;
        border: 1px solid #c3e6cb;
        animation: fadeOut 4s linear forwards;
        display: block;
    }

    .sweetSuccessMessage {
        position: fixed;
        height: 70px;
        top: 50px;
        right: 10px;
        background-color: #6600FF !important;
        color: white;
        padding: 25px;
        border: 1px solid #c3e6cb;
        animation: fadeOut 4s linear forwards;
        display: block;
    }
</style>

{{-- start sweet Message --}}
@if (session()->has('success'))
    <div class="sweetSuccessMessage">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="sweetErrormessage">
        {{ session()->get('error') }}

    </div>
@endif
{{-- end sweet Message --}}

<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>
                @if (@$updateUser)
                    Update Customer <i class="fa-solid fa-cart-plus"></i>
                @else
                    Add Customer <i class="fa-solid fa-cart-plus"></i>
                @endif
            </h1>


        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form
                    action="{{ @$updateUser ? route('admin.updateUser', $updateUser->id) : route('admin.addCustomer') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="add-input-container">
                        <div class="profile-label">
                            <label for="">Register As: <span style="color: #ff0000">*</span></label>
                        </div>
                        <!-- <input type="text"  placeholder="Register Service As"> -->
                        <select name="user_type_id">
                            @foreach ($userTypes as $userType)
                                <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="whole-input-container " style="padding-top: 20px">
                        <div class="whole-input-container">
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Full Name : <span style="color: #ff0000">*</span></label>
                                </div>
                                <input type="text" placeholder="Enter Your Full Name" name="name"
                                    value="@if (@$updateUser) {{ $updateUser->name }} @endif">
                                @error('name')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Phone Number : <span style="color: #ff0000">*</span></label>
                                </div>
                                <input type="text" placeholder="Enter Phone Number" name="contact_number"
                                    value="@if (@$updateUser) {{ $updateUser->contact_number }} @endif">
                                @error('contact_number')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">location : <span style="color: #ff0000">*</span></label>
                                </div>
                                <input type="text" placeholder="Enter Your location" name="address"
                                    value="@if (@$updateUser) {{ $updateUser->address }} @endif">
                                @error('location')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Your Latitude:</label>
                                </div>
                                <input type="text" placeholder="Enter Latitude" name="latitude"
                                    value="@if (@$updateUser) {{ $updateUser->latitude }} @endif">
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Your Longitude:</label>
                                </div>
                                <input type="text" placeholder="Enter Longitude" name="longitude"
                                    value="@if (@$updateUser) {{ $updateUser->longitude }} @endif">
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Email : <span style="color: #ff0000">*</span></label>
                                </div>
                                <input type="text" placeholder="Enter Email" name="email"
                                    value="@if (@$updateUser) {{ $updateUser->email }} @endif">
                                @error('email')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Password : <span style="color: #ff0000">*</span></label>
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
                                    <label for="">Confirm Password : <span
                                            style="color: #ff0000">*</span></label>
                                </div>
                                <input type="text" placeholder="Enter Confirm Password" name="conform_password">
                                @error('conform_password')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="whole-input-container">
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Description</label>
                                </div>
                                <textarea name="description " id="" cols="80" rows="8"
                                    style="  
                                    padding: 5px; 
                                    border:0.5px solid rgb(202, 202, 202); 
                                    width:auto">@if (@$updateUser){{ $updateUser->description }}@endif</textarea>
                            </div>

                        </div>
                        <button class="add-items">
                            Add Customer
                        </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
