@php
    $currentPage = 'profile';
@endphp
@php
    $id = session()->get('userLogedIn');
    $user = DB::table('users')
        ->where('id', $id)
        ->first();
@endphp


@include('customer.include.header')
<!---Logo Navbar Ends Here-->

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

    <div class="profile-containers">
        <div class="title-profile">
            <h2>User Profile</h2>
        </div>
        <div class="profile-information">
            <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-information">
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Your Name:</label>
                        </div>
                        <input type="text" value="{{ @$user->name }}" placeholder="Enter Name" name="name">
                        @error('name')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Email Address:</label>
                        </div>
                        <input type="email" value="{{ @$user->email }}" placeholder="Your Email Address"
                            name="email">
                        @error('email')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Contact No:</label>
                        </div>
                        <input type="text" value="{{ @$user->contact_number }}" placeholder="Your Contact Number"
                            name="contact_number">
                        @error('contact_number')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Your Address:</label>
                        </div>
                        <input type="text" value="{{ @$user->address }}" value="Pokhara" placeholder="Enter Address"
                            name="address">
                        @error('address')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Your Latitude:</label>
                        </div>
                        <input type="text"
                            value="@if (@$user->latitude == null) @else @endif{{ @$user->latitude }}"
                            placeholder="Enter Latitude" name="latitude">
                        @error('latitude')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="profile-container">
                        <div class="profile-label">
                            <label for="">Your Longitude:</label>
                        </div>
                        <input type="text"
                            value="@if (@$user->longitude == null) @else @endif{{ @$user->longitude }}"
                            placeholder="Enter Longitude" name="longitude">
                        @error('longitude')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
                <div style="padding: 20px">
                    <div>
                        <div class="profile-label">
                            <label for="">Patient Description:</label>
                        </div>
                        <textarea style="width: 100%; height:200px; padding: 5px" placeholder="Describe The Patient" name="description" >{{ @$user->description }}
                        </textarea>
                    </div>
                </div>
                {{-- user profile picture --}}
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
                    @if (@$user->profile_picture != null)
                        <div class="profile-container">
                            <div class="profile-label">
                                <label for="">Your Profile Picture:</label>
                            </div>
                            <img src="{{ asset($user->profile_picture) }}" alt=""
                                style="
                                width: 50%;">
                        </div>
                    @else
                        <div class="profile-img">
                            <img src="{{ asset('oxygen/resources/images/user-profile.png') }}" alt="">
                        </div>
                    @endif
                </div>


                <div class="button-update">
                    <button class="profile-button">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>
@include('customer.include.footer')
