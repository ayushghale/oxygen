@php
    $id = session()->get('userLogedIn');
    $user = DB::table('users')
        ->where('id', $id)
        ->first();
@endphp
<div class="nav-info">
    <div class="profie-pic-info-1" style="border-bottom: 1px solid var(--color5);">
        @if (@$user->profile_picture != null)
            <div class="profile-pic">
                <img src="{{ asset($user->profile_picture) }}" alt="">
            </div>
        @else
            <div class="profile-pic">
                <img src="{{ asset('oxygen/resources/images/user-profile.png') }}" alt="">
            </div>
        @endif
        <div class="information">
            <p>{{ $user->name }}</p>
            <p>+977 {{ $user->contact_number }}</p>
        </div>
    </div>
    <div class="nav-links">
        <ul>
            {{-- dashboard --}}
            <a href="{{ route('user.dashboard') }}" class="{{ $currentPage === 'dashboard' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'dashboard' ? 'active-nav' : '' }}">Dashboard</li>
            </a>
            {{-- Update profile --}}
            <a href="{{ route('user.profile') }}" class="{{ $currentPage === 'profile' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'profile' ? 'active-nav' : '' }}">Update Profile</li>
            </a>
            {{-- Update password --}}
            <a href="{{ route('user.credentials') }}" class="{{ $currentPage === 'updateProfile' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'updateProfile' ? 'active-nav' : '' }}">Update Password</li>
            </a>
            {{-- purchase service --}}
            <a href="{{ route('user.purchaseService') }}" class="{{ $currentPage === 'purchaseService' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'purchaseService' ? 'active-nav' : '' }}">Services</li>
            </a>
            {{-- cart --}}
            <a href="{{ route('user.cart') }}" class="{{ $currentPage === 'cart' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'cart' ? 'active-nav' : '' }}">Cart</li>
            </a>
            {{-- order to recive --}}
            <a href="{{ route('user.orderToRecive') }}" class="{{ $currentPage === 'orderToRecive' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'orderToRecive' ? 'active-nav' : '' }}">Order To Receive</li>
            </a>
            {{-- purchase history --}}
            <a href="{{ route('user.purchaseHistory') }}" class="{{ $currentPage === 'purchase' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'purchase' ? 'active-nav' : '' }}">Order History</li>
            </a>
            {{-- my reviews --}}
            <a href="{{ route('user.review') }}" class="{{ $currentPage === 'review' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'review' ? 'active-nav' : '' }}">My Reviews</li>
            </a>
            {{-- ledger --}}
            <a href="{{ route('user.ledger') }}" class="{{ $currentPage === 'ledger' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'ledger' ? 'active-nav' : '' }}">ledger</li>
            </a>
            {{-- user details --}}
            <a href="{{ route('user.userDetail') }}" class="{{ $currentPage === 'userDetail' ? 'active-a' : '' }}">
                <li class="{{ $currentPage === 'userDetail' ? 'active-nav' : '' }}">User Details</li>
            </a>
            <!-- Add similar code for other links in the menu -->
        </ul>
    </div>
</div>