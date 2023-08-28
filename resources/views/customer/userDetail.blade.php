@php
    $currentPage = 'userDetail';
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

    .product-desc textarea {
        margin-top: 10px;
        padding: 10px;
        font-size: 15px;
        width: 100%;
        border: 1px solid var(--color5);
        height: 180px;
    }

    .product-desc {
        width: 100%;
    }

    .tHeading {
        padding: 30px 15px 0px 30px;
        width: 30%;
    }
    .tbody{
        padding: 30px 0px 0px 0px;
    }

    th,
    td {
        text-align: left;
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
    <p><a href="">Home</a> > User Detail</p>
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
        <div>
            <table style="width:100%">
                <tr>
                    <th class="tHeading">Name:</th>
                    <td class="tbody">{{ @$user->name }}</td>
                </tr>
                <tr>
                    <th class="tHeading">Email Address:</th>
                    <td class="tbody">{{ @$user->email }}</td>
                </tr>
                <tr>
                    <th class="tHeading">Contact No:</th>
                    <td class="tbody">{{ @$user->contact_number }}</td>
                </tr>
                <tr>
                    <th class="tHeading">Your Address:</th>
                    <td class="tbody">{{ @$user->address }}</td>
                </tr>
                <tr>
                    <th class="tHeading">Your Latitude:</th>
                    <td class="tbody">
                        @if (@$user->latitude == null)
                            Null
                        @else
                            {{ @$user->latitude }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="tHeading">Your Longitude:</th>
                    <td class="tbody">
                        @if (@$user->longitude == null)
                            Null
                        @else
                            {{ @$user->longitude }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="tHeading">Patient Description:</th>
                    <td class="tbody">
                        @if (@$user->description == null)
                            Null
                        @else
                            {{ @$user->description }}
                        @endif

                    </td>
                </tr>
                <tr>
                    <th class="tHeading">Your Profile Picture:</th>
                    <td class="tbody">
                        @if (@$user->profile_picture != null)
                            <img src="{{ asset($user->profile_picture) }}" alt="" style="width: 30%;">
                        @else
                            <img src="{{ asset('oxygen/resources/images/user-profile.png') }}" alt="">
                        @endif
                    </td>
                </tr>

            </table>
        </div>

        {{-- <div class="profile-information">
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Name: {{ @$user->name }}</label>
                </div>
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Email Address: {{ @$user->email }}</label>
                </div>
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Contact No: {{ @$user->contact_number }}</label>
                </div>
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Your Address: {{ @$user->address }}</label>
                </div>
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Your Latitude: @if (@$user->latitude == null)
                            Null
                        @else
                        @endif{{ @$user->latitude }}</label>
                </div>
            </div>
            <div class="profile-container">
                <div class="profile-label">
                    <label for="">Your Longitude: @if (@$user->longitude == null)
                            Null
                        @else
                        @endif{{ @$user->longitude }}</label>
                </div>
            </div>
            <div class="product-desc">
                <div class="profile-label">
                    <label for="">Patient Description:</label>
                </div>
                <textarea placeholder="Describe The Patient" name="description"></textarea>
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
        </div> --}}

    </div>
</div>
@include('customer.include.footer')
