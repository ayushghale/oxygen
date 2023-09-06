{{-- start sweet Message --}}
@if (session()->has('success'))
    <div class="snackbar">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="snackbar">
        {{ session()->get('error') }}
    </div>
@endif
{{-- end sweet Message --}}
<!--Modal PopUp login-->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="loginForm">
            <h2>Login</h2>
            <p id="accountActivate" class="error"></p>
            <div class="login-input">
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Enter Email:</label>
                    </div>
                    <input type="text" placeholder="Enter Your Username" id="p_email">
                    <p id="loginEmail" class="error"></p>
                    <p id="loginEmailError" class="error"></p>
                </div>
                <div class="inp-cont" style="margin-bottom: 20px;">
                    <div class="label-container">
                        <label>Your Password:</label>
                    </div>
                    <input type="password" placeholder="Enter Your Password" id="p_password">
                    <p id="loginPassword" class="error"></p>
                    <p id="loginpasswordError" class="error"></p>
                </div>
                <a href="{{ route('user.forgetPassword') }}">Forget Your Password?</a>
                <button class="modal-button" onclick="loginUser()">Login <i
                        class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Model Popup register --}}
<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="registerForm">
            <h2>Register </h2>
            <div class="login-input">
                {{-- <form id="myForm" action="{{ url('user/register') }}" method="POST">
                    @csrf --}}
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Enter Your Full Name :</label>
                    </div>

                    <input type="text" placeholder="Enter Your Username" name="name" id="name">
                    <p id="nameError" class="error"></p>
                </div>
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Enter Mobile Number :</label>
                    </div>

                    <input type="text" placeholder="Enter Your Number" name="contact_number" id="contact_number">
                    <p id="contact_numberError" class="error"></p>
                </div>
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Enter Email :</label>
                    </div>

                    <input type="email" placeholder="Enter Your email" name="email" id="email">
                    <div id="emailError" class="error"></div>
                </div>
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Enter Password :</label>
                    </div>

                    <input type="password" placeholder="Enter Password" name="password" id="password">
                    <p id="passwordError" class="error"></p>
                </div>
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Confirm Your Password :</label>
                    </div>

                    <input type="password" placeholder="Confirm Password" name="conform_password" id="conform_password">
                    <p id="cPasswordError" class="error"></p>
                </div>

                <div class="inp-cont">
                    <div class="label-container">
                        <label>Location :</label>
                    </div>
                    <input type="text" placeholder="Enter Your Location" name="address" id="address">
                    <p id="addressError" class="error"></p>
                </div>
                <div class="inp-cont">
                    <div class="label-container">
                        <label>Register As :</label>
                    </div>

                    <select name="user_type_id" id="user_type_id">
                        <option value="">Select User Type</option>
                        @foreach ($userTypes as $userType)
                            <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                        @endforeach
                    </select>
                    <p id="userType" class="error"></p>
                </div>
                <!-- Your login-input div -->
                <div class="login-input">
                    <!-- ... (rest of the code) ... -->
                    <button class="modal-button" onclick="registerUser();">
                        Register <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!---Modal Popup Ends-->

@if (session()->has('userLogedIn'))
    <div class="user-profile-border">
        <div class="container">
            <div class="logo-navabar">
                <div class="logo">
                    <img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt="">
                </div>
                <div class="login-register">
                    <div class="login-dropdown">
                        <i class="fa-solid fa-circle-user"></i>
                        <p>{{ $username }} <i class="fa-sharp fa-solid fa-caret-down down-account-arrow"></i></p>
                        <ul class="dropdown-menu-contents">
                            <div class="caret-up">
                                <i class="fa-solid fa-caret-up"></i>
                            </div>
                            <li><a href="{{ route('user.dashboard') }}">Profile</a></li>
                            <li><a href="{{ route('user.logout') }}">Log Out <i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="logo-navabar">
            <div class="logo">
                <a href="/"><img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt=""></a>
            </div>
            <div class="login-register">
                <div class="join-us" id="registerBtn">
                    <p>JOIN US</p>

                </div>

                <div class="login-button">
                    <button class="log-button" id="loginBtn">Login</button>
                </div>
            </div>
        </div>

    </div>
@endif
