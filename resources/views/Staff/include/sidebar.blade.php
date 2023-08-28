@php
    $id = session()->get('staffLogedIn');
    $user = DB::table('admins')
        ->where('id', $id)
        ->first();
@endphp
<div class="nav-info">
    <div class="profie-pic-info-1" style="border-bottom: 1px solid var(--color5);">
        <div class="profile-pic">
            <img src="{{ asset('oxygen/resources/images/user-profile.png') }}" alt="">
        </div>
        <div class="information">
            <p>{{ $user->name }}</p>
            <p>{{ $user->contact_number }}</p>
            {{-- <p>Address : {{ $user->contact_number }}</p> --}}
        </div>
    </div>
    <div class="nav-links">
        <ul>
            {{-- dashboard --}}
            <a href="{{ route('staff.dashboard') }}" class="{{ $currentPage === 'dashboard' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'dashboard' ? 'active-nav' : '' }}">Dashboard</li>
            </a>
            {{-- update profile --}}
            <a href="{{ route('staff.profile') }}" class="{{ $currentPage === 'profile' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'profile' ? 'active-nav' : '' }}">Update Profile</li>
            </a>
            {{-- update password --}}
            <a href="{{ route('staff.credentials') }}" class="{{ $currentPage === 'updateProfile' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'updateProfile' ? 'active-nav' : '' }}">Update Password</li>
            </a>
            {{-- purchase service --}}
            {{-- <a href="{{ route('staff.review') }}" class="{{ $currentPage === 'review' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'review' ? 'active-nav' : '' }}">Reviews</li>
            </a> --}}
            {{-- cart --}}
            <a href="{{ route('staff.ledger') }}" class="{{ $currentPage === 'ledger' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'ledger' ? 'active-nav' : '' }}">ledger</li>
            </a>    
            {{-- order asigned --}}
            <a href="{{ route('staff.orderAsigned') }}" class="{{ $currentPage === 'orderAsigned' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'orderAsigned' ? 'active-nav' : '' }}">Order Asigned</li>
            </a>
            {{-- order completed --}}
            <a href="{{ route('staff.orderCompleted') }}" class="{{ $currentPage === 'orderCompleted' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'orderCompleted' ? 'active-nav' : '' }}">Order Completed</li>
            </a>
        </ul>
    </div>
</div>