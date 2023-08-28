@php
    $currentPage = 'profile';
@endphp



@include('staff.include.header')

<style>
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
    }

    .sweetSuccessMessage {
        position: fixed;
        height: 70px;
        top: 30px;
        right: 10px;
        background-color: #6600FF !important;
        color: white;
        padding: 25px;
        border: 1px solid #c3e6cb;
        animation: fadeOut 4s linear forwards;
    }
</style>
<!---Logo Navbar Ends Here-->
<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->

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


<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}


    @include('staff.include.sidebar')
    {{-- sidebar end --}}

    <div class="profile-containers">
        <div class="title-profile">
            <h2>Inpatient Profile</h2>
        </div>
        <form action="" method="POST">
            <div class="profile-information">

                {{-- name --}}
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">Service Provider Name:</label>
                    </div>
                    <input type="text" value="{{ $admins->name }}" placeholder="Enter Name">
                </div>

                {{-- email --}}
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">Email Address:</label>
                    </div>
                    <input type="email" placeholder="Your Email Address" value="{{ $admins->email }}">
                </div>

                {{-- contact no --}}
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">Phone No:</label>
                    </div>
                    <input type="text" placeholder="Your Email Address" value="{{ $admins->contact_number }}">
                </div>

                {{-- location --}}
                <div class="profile-container">
                    <div class="profile-label">
                        <label for="">location : </label>
                    </div>
                    <input type="location" placeholder="Your location   " value="{{ $admins->address }}">
                </div>

                {{-- photo --}}
                <div class="profile-information">
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Update Profile Picture:</label>
                        </div>
                        <input type="file" style="border: transparent; margin-left: -10px; cursor: pointer;"
                            name="profile_picture">
                        @error('profile_picture')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    @if (@$admins->profile_picture != null)
                        <div class="profile-container">
                            <div class="profile-label">
                                <label for="">Your Profile Picture:</label>
                            </div>
                            <img src="{{ asset($admins->profile_picture) }}" alt=""
                                style="
                                width: 50%;">
                        </div>
                    @else
                        <div class="profile-img">
                            <img src="{{ asset('oxygen/resources/images/user-profile.png') }}" alt="">
                        </div>
                    @endif
                </div>

                {{-- submit --}}
                <div class="button-update">
                    <button class="profile-button">Update</button>
                </div>
            </div>
        </form>

    </div>

</div>
@include('staff.include.footer')
