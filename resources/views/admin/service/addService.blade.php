<?php
$currentPage = 'serviceFormPage';
$currentNav = 'service';
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
                                @error('user_type_id')
                                    <div class="error" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Service Name:</label>
                            </div>
                            <input type="text" placeholder="Enter Service Name" name="name"
                                value="@if (@$serviceDetail) {{ $serviceDetail->service_name }} @endif">
                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Price:</label>
                            </div>
                            <input type="text" placeholder="Enter Price" name="price" id="price"
                                value="@if (@$serviceDetail) {{ $serviceDetail->service_price }} @endif">
                            @error('price')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Change Profile Picture:</label>
                            </div>
                            <input type="file" style="border: none; width: auto;" name="image">
                            @error('image')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        @if (@$serviceDetail)
                            <div class="add-input-container">
                                <div class="profile-label">
                                    <label for="">Current Image:</label>
                                </div>
                                <img src="{{ asset($serviceDetail->service_image) }}" style="width: 200px"
                                    alt="">
                            </div>
                        @endif
                        <div class="product-desc">
                            <div class="profile-label">
                                <label for="">Product Description:</label>
                            </div>
                            <textarea placeholder="Describe The Product" name="description">
@if (@$serviceDetail)
{{ $serviceDetail->service_description }}
@endif
</textarea>
                            @error('description')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
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

<script>
    var priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function() {
        var inputValue = this.value;

        var numericValue = inputValue.replace(/[^0-9]/g, '');

        this.value = numericValue;
    });
</script>

@include('admin.include.footer')
