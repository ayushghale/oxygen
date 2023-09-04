@php
    $id = session()->get('userLogedIn');
    $userName = DB::table('users')
        ->where('id', $id)
        ->value('name');

    
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('oxygen/resources/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('oxygen/resources/css/sewwetMesssage.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('oxygen/resources/css/dashboard.css')}}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>


<body>
    <!----Logo Navbar Starts Here-->
    <div class="user-profile-border">
        <div class="container">
            <div class="logo-navabar">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt="">
                    </a>
                </div>
                <div class="login-register">
                    <div class="login-dropdown">
                        <i class="fa-solid fa-circle-user"></i>
                        <p>{{ $userName }}<i class="fa-sharp fa-solid fa-caret-down down-account-arrow"></i></p>
                        <ul class="dropdown-menu-contents">
                            <div class="caret-up">
                                <i class="fa-solid fa-caret-up"></i>
                            </div>
                            <li><a href="{{ route('user.dashboard') }}">User Profile</a></li>
                            <li><a href="{{ route('user.logout') }}">Log Out <i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
