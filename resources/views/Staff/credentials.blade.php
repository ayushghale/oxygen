@php
    $currentPage = 'updateProfile';
@endphp

@include('staff.include.header')
<!---Logo Navbar Ends Here-->
<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar --}}
    @include('staff.include.sidebar')
    {{-- sidebar end --}}


    <div class="profile-containers">
        <div class="title-profile">
            <h2>Update Profile</h2>
        </div>
        <div class="profile-information">

            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Current Password:</label>
                </div>
                <input type="password" placeholder="Current Password">
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">New Password:</label>
                </div>
                <input type="password" placeholder="New Password">
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Confirm Password:</label>
                </div>
                <input type="password" placeholder="Confirm Your New Password">
            </div>
            <div class="button-update">
                <button class="profile-button">Update</button>
            </div>

        </div>

    </div>
</div> 

@include('staff.include.footer')
 