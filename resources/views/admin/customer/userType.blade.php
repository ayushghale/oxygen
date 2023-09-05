<?php
$currentPage = 'userType';
$currentNav = 'customer';
?>

@include('admin.include.header')




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
