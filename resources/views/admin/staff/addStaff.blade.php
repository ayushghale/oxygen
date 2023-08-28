<?php
$currentPage = 'staffRegisterPage';
$currentDiv = 'staff';
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
                                value="@if (@$staffDetail) {{ $staffDetail->name }} @endif">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Phone Number :</label>
                            </div>
                            <input type="text" placeholder="Enter Phone Number" name="contact_number"
                            value="@if (@$staffDetail) {{ $staffDetail->contact_number }} @endif">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Email :</label>
                            </div>
                            <input type="text" placeholder="Enter Email" name="email"
                            value="@if (@$staffDetail) {{ $staffDetail->email }} @endif">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Password" name="password">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Confirm Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Confirm Password" name="confirm_Password">
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
