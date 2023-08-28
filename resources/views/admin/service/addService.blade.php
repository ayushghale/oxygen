<?php
$currentPage = 'serviceFormPage';
$currentDiv = 'service';
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
                @if (@$serviceDetail)
                    Update
                @else
                    Add
                @endif Service <i class="fa-solid fa-cart-plus"></i>
            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form
                    action="{{ @$serviceDetail ? route('admin.updateService', $serviceDetail->id) : route('admin.addService') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Register As:</label>
                            </div>
                            <!-- <input type="text"  placeholder="Register Service As"> -->
                            <select name="user_type_id">
                                <option value="0">Register As:</option>
                                @if (@$serviceDetail)
                                    @foreach ($userTypes as $userType)
                                        @if ($userType->id == $serviceDetail->user_type_id)
                                            <option value="{{ $userType->id }}" selected>{{ $userType->user_type_name }}
                                            </option>
                                        @else
                                            <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($userTypes as $userType)
                                        <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Service Name:</label>
                            </div>
                            <input type="text" placeholder="Enter Service Name" name="name"
                                value="@if (@$serviceDetail) {{ $serviceDetail->service_name }} @endif">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Price:</label>
                            </div>
                            <input type="text" placeholder="Enter Price" name="price"
                                value="@if (@$serviceDetail) {{ $serviceDetail->service_price }} @endif">
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Change Profile Picture:</label>
                            </div>
                            <input type="file" style="border: none; width: auto;" name="image">
                        </div>
                        @if (@$serviceDetail)
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Current Image:</label>
                                </div>
                                <img src="{{ asset('storage/service/' . $serviceDetail->image) }}" alt=""
                                    style="width: 100px; height: 100px;">
                            </div>
                        @endif
                        <div class="product-desc">
                            <div class="profile-label">
                                <label for="">Product Description:</label>
                            </div>
                            <textarea placeholder="Describe The Product" 
                            name="description">@if (@$serviceDetail){{ $serviceDetail->service_description }}@endif</textarea>
                        </div>
                    </div>
                    <button class="add-items">
                        Add Product
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
