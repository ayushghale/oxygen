@php
    $currentPage = 'updateProfile';
@endphp

@include('customer.include.header')
<!---Logo Navbar Ends Here-->


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

<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->

<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('customer.include.sidebar')
    {{-- sidebar end --}}

    {{-- user credincals form --}}
    <div class="profile-containers">
        <div class="title-profile">
            <h2>Update Profile</h2>
        </div>

        {{-- sweet alert message --}}
        <form action="{{ route('user.updateCredentials') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-information">
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">Current Password:</label>
                    </div>
                    <input type="password" placeholder="Current Password" name="current_Password" >
                    @error('current_Password')
                        <div class="error" role="alert">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">New Password:</label>
                    </div>
                    <input type="password" placeholder="New Password" name="new_password">
                    @error('new_password')
                        <div class="error" role="alert">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">Confirm Password:</label>
                    </div>
                    <input type="password" placeholder="Confirm Your New Password" name="conform_password">
                    @error('conform_password')
                        <div class="error" role="alert">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="button-update">
                    <button class="profile-button">Update</button>
                </div>
            </div>
        </form>

    </div>
    {{-- form end --}}
</div>
@include('customer.include.footer')
