<?php
$currentPage = 'userType';
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
                @if (@$userTypeDetail)
                    Edit
                @else
                    Add
                @endif User Type
                <i class="fa-solid fa-cart-plus"></i>
            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{@$userTypeDetail ? route('admin.updateUserType',$userTypeDetail->id) : route('admin.addUserType') }}" method="POST">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">User type :</label>
                            </div>
                            <input type="text" placeholder="Enter User type" name="name"
                            value="@if (@$userTypeDetail){{ $userTypeDetail->user_type_name }} @endif">
                        </div>
                    </div>
                    <button class="add-items">
                        @if (@$userTypeDetail)
                            Update
                        @else
                            Add
                        @endif
                    </button>
                </form>
            </div>

        </div>

    </section>

</div>
@include('admin.include.footer')
