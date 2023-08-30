<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oxygen</title>
    <link rel="stylesheet" href="{{ asset('oxygen/resources/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

@php
    $id = session()->get('staffLogedIn');
    $user = DB::table('admins')
        ->where('id', $id)
        ->first();
@endphp
<body>
    <!----Logo Navbar Starts Here-->
    <div class="user-profile-border">
        <div class="container">
            <div class="logo-navabar">
                <div class="logo">
                    <img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt="">
                </div>
                <div class="login-register">
                    <!-- <div class="join-us" id="registerBtn">
                        <p>JOIN US</p>
    
                    </div>
                  
                   <div class="login-button"  id="loginBtn">
                    <button class="log-button">Login</button>
                   </div> -->
                    <div class="login-dropdown">
                        <i class="fa-solid fa-circle-user"></i>
                        <p>{{ $user->name }}<i class="fa-sharp fa-solid fa-caret-down down-account-arrow"></i></p>
                        <ul class="dropdown-menu-contents">
                            <div class="caret-up">
                                <i class="fa-solid fa-caret-up"></i>
                            </div>
                            <li><a href="{{ route('staff.dashboard') }}">Profile</a></li>
                            <li><a href="{{ route('staff.logout') }}">Log Out <i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
