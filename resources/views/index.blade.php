
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Oxygen Implant</title>
    <link rel="stylesheet" href="{{ asset('oxygen/resources/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<style>
    .error {
        color: red;
        display: block;
    }
</style>

<body>

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

                        <input type="password" placeholder="Confirm Password" name="conform_password"
                            id="conform_password">
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

    <!----Logo Navbar Starts Here-->
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
                    <a href="/"><img src="{{ asset('oxygen/resources/images/oxygen.png') }}"
                            alt=""></a>
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

    <!---Logo Navbar Ends Here-->

    <!---Banner Starts Here-->

    <div class="background">
        <div class="container">
            <div class="banner-image-container">
                <div class="banner-description" data-aos="fade-right" data-aos-duration="700">
                    <h1>Lorem ipsum dolor sit,<span> amet consectetur adipisicing</span> elit, Quisquam tenetur?</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse labore excepturi debitis ipsum
                        nisi sunt expedita numquam similique perspiciatis consequatur optio provident accusamus
                        quibusdam ullam harum dicta, aut nam! Libero.</p>
                    <div class="login-button">
                        <button class="log-button join-us" id="registerBtn">Join Us</button>
                    </div>
                </div>

                <div class="banner-image" data-aos="fade-left" data-aos-duration="700">
                    <img src="{{ asset('oxygen/resources/images/7510911.png') }}" alt="">
                </div>
            </div>

        </div>
    </div>
    <!---Banner Ends Here-->

    <!---How To Register Starts Here-->
    <div class="whole-background">

        <div class="container contain-background">
            <h1 data-aos="fade-down" data-aos-duration="700">Steps For Joining Us</h1>
            <div class="steps-containers">
                <div class="stp-container" data-aos="fade-down" data-aos-duration="900">
                    <h3>Register</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="stp-container m-10" data-aos="fade-down" data-aos-duration="1400">
                    <h3>Register</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum? </p>
                </div>
                <div class="stp-container m-20" data-aos="fade-down" data-aos-duration="1900">
                    <h3>Register</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum? </p>
                </div>
                <div class="stp-container m-30" data-aos="fade-down" data-aos-duration="2400">
                    <h3>Register</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum? </p>
                </div>
            </div>
        </div>
    </div>
    <!---How To Register Ends Here-->

    <!--Our Services Starts Here-->
    <div class="dotted-bg-background">
        <div class="dotted-background">
        </div>
        <div class="container our-services">
            <h1>Our Services</h1>
            <div class="services-containers">
                <div class="serv-container" data-aos="fade-up" data-aos-duration="800">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service0</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="serv-container" data-aos="fade-up" data-aos-duration="900">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service1</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="serv-container" data-aos="fade-up" data-aos-duration="1000">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service2</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="serv-container" data-aos="fade-up" data-aos-duration="1100">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service3</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="serv-container" data-aos="fade-up" data-aos-duration="1200">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service4</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
                <div class="serv-container" data-aos="fade-up" data-aos-duration="1300">
                    <div class="serv-images">
                        <img src="{{ asset('oxygen/resources/images/services.png') }}" alt=""
                            style="height: 90px;">
                    </div>
                    <h3>Service5</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia consequuntur earum impedit est
                        necessitatibus odit, atque, ipsa illum illo odio possimus architecto eum?</p>
                </div>
            </div>
        </div>
    </div>
    <!---Our Services Ends Here-->

    <!--Service hrs-->
    <div class="background1">
        <div class="container">
            <div class="banner-image-container">
                <div class="banner-description" style="margin-top: 30px;" data-aos="fade-right"
                    data-aos-duration="800">
                    <h1><span> 24/7 <br> Support</span></h1>
                    <p>We are in support 24 hrs a day, every day of the week ,including holidays.</p>
                    <div class="login-button">
                        <button class="log-button">Contact Us</button>
                    </div>
                </div>

                <div class="banner-image" data-aos="fade-left" data-aos-duration="800">
                    <img src="{{ asset('oxygen/resources/images/24hours.png') }}" alt=""
                        style="top:20px; right:20px ;">
                </div>
            </div>

        </div>
    </div>
    <!--Services hrs ends-->

    <!--footer starts here-->

    <footer>
        <div class="container">
            <div class="footer-top">
                <div class="fot-cont">
                    <h2>Sitemap</h2>
                    <ul>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Home Page</a></li>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Help And Support</a> </li>
                    </ul>
                </div>
                <div class="fot-cont">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Login</a></li>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Register</a></li>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Private Policy</a></li>
                        <li><a href=""><i class="fa-solid fa-arrow-right"></i> Serurity Policy</a> </li>
                    </ul>
                </div>
                <div class="fot-cont">
                    <h2>Social Links</h2>
                    <ul class="social-links">
                        <li><a href=""><i class="fa-brands fa-square-facebook"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="fot-cont">
                    <h2>About Us</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente voluptatibus quae repudiandae
                        earum itaque quia ex, et quo doloribus? Iste maiores aperiam nulla vero magni amet dolores quo
                        id voluptas?</p>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            <div class="container bottom-footer-container">
                <div class="mobile-app-pictures">
                    <img src="{{ asset('oxygen/resources/images/play-store.png') }}" alt="">
                    <img src="{{ asset('oxygen/resources/images/apple-store.png') }}" alt="">
                </div>
                <div class="design-develop-by">
                    <p>© 2023 Oxygen. All rights reserved | Designed & Developed by <a href="">Tuki Soft</a></p>
                </div>
            </div>
        </div>

    </footer>
    <!--Footer Ends Here-->


</body>
<script>
    function registerUser() {
        try {
            var name = document.getElementById("name").value;
            var contact_number = document.getElementById("contact_number").value;
            var email = document.getElementById("email").value;
            var address = document.getElementById("address").value;
            var password = document.getElementById("password").value;
            var conform_password = document.getElementById("conform_password").value;
            var user_type_id = document.getElementById("user_type_id").value;

            if (user_type_id == 0) {
                alert('select user type');
                document.getElementById("userType").innerText = "The user type field is required.";
                document.getElementById("userType").style.display = "block";
                return false;
            }

            // Create a data object with the form values
            var formData = {
                name: name,
                contact_number: contact_number,
                email: email,
                address: address,
                password: password,
                conform_password: conform_password,
                user_type_id: user_type_id
            };

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            console.log(formData);
            // Serialize the data object to a JSON string
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            // Send the data using AJAX
            $.ajax({
                url: "user/register", // Replace this with the URL of your server endpoint
                type: "POST", // Use "POST" if you want to send data to the server
                data: formData,
                success: function(response) {
                    // Handle the response from the server if needed

                    console.log("Data sent successfully!");
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(status);
                    console.log(error);
                    // Handle error response and display validation errors
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        // Handle each validation error here, for example:
                        // username error
                        if (errors.name) {
                            document.getElementById("nameError").innerText = errors.name[0];
                            document.getElementById("nameError").style.display = "block";
                        } else {
                            document.getElementById("nameError").innerText = "";
                            document.getElementById("nameError").style.display = "none";
                        }
                        // contact number error
                        if (errors.contact_number) {
                            document.getElementById("contact_numberError").innerText = errors
                                .contact_number[0];
                            document.getElementById("contact_numberError").style.display = "block";
                        } else {
                            document.getElementById("contact_numberError").innerText = "";
                            document.getElementById("contact_numberError").style.display = "none";
                        }
                        // email error
                        if (errors.email) {
                            document.getElementById("emailError").innerText = errors.email[0];
                            document.getElementById("emailError").style.display = "block";
                        } else {
                            document.getElementById("emailError").innerText = "";
                            document.getElementById("emailError").style.display = "none";
                        }
                        // password error
                        if (errors.password) {
                            document.getElementById("passwordError").innerText = errors.password[0];
                            document.getElementById("passwordError").style.display = "block";
                        } else {
                            document.getElementById("passwordError").innerText = "";
                            document.getElementById("passwordError").style.display = "none";
                        }
                        if (errors.conform_password) {
                            document.getElementById("cPasswordError").innerText = errors.conform_password[
                                0];
                            document.getElementById("cPasswordError").style.display = "block";
                        } else {
                            document.getElementById("cPasswordError").innerText = "";
                            document.getElementById("cPasswordError").style.display = "none";
                        }
                        // confirm password error
                        if (errors.address) {
                            document.getElementById("addressError").innerText = errors.address[0];
                            document.getElementById("addressError").style.display = "block";
                        } else {
                            document.getElementById("addressError").innerText = "";
                            document.getElementById("addressError").style.display = "none";
                        }
                        // user type error
                        if (errors.user_type_id) {
                            document.getElementById("userType").innerText = 'select user type';
                            document.getElementById("userType").style.display = "block";
                        } else {
                            document.getElementById("userType").innerText = "";
                            document.getElementById("userType").style.display = "none";
                        }
                    } else {
                        document.getElementById("nameError").innerText = "";
                        document.getElementById("nameError").style.display = "none";
                        document.getElementById("contact_numberError").innerText = "";
                        document.getElementById("contact_numberError").style.display = "none";
                        document.getElementById("emailError").innerText = "";
                        document.getElementById("emailError").style.display = "none";
                        document.getElementById("passwordError").innerText = "";
                        document.getElementById("passwordError").style.display = "none";
                        document.getElementById("addressError").innerText = "";
                        document.getElementById("addressError").style.display = "none";
                    }
                }
            });
        } catch (e) {
            console.log(e);
        }
    }

    // user login
    function loginUser() {
        var email = document.getElementById("p_email").value;
        var password = document.getElementById("p_password").value;

        console.log(email, password);

        // Create a data object with the form values
        var formData = {
            email: email,
            password: password
        };

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        try {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            // Send the data using AJAX
            $.ajax({
                url: "user/login", // Replace this with the URL of your server endpoint
                type: "POST", // Use "POST" if you want to send data to the server
                data: formData,
                success: function(response) {
                    // Handle the response from the server if needed
                    // window.location.href = "/user/dashboard";
                    console.log("Data sent successfully!");
                    window.location.href = '/user/dashboard';

                },
                error: function(xhr, status, error) {
                    console.log(status);
                    console.log(error);
                    // Handle error response and display validation errors
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        // Email error
                        if (errors.email) {
                            alert(errors.email[0]);
                            document.getElementById("loginEmail").innerText = errors.email[0];
                            document.getElementById("loginEmail").style.display = "block";
                        } else {
                            document.getElementById("loginEmail").innerText = "";
                            document.getElementById("loginEmail").style.display = "none";
                        }

                        // Password error
                        if (errors.password) {
                            alert(errors.password[0]);
                            document.getElementById("loginPassword").innerText = errors.password[0];
                            document.getElementById("loginPassword").style.display = "block";
                        } else {
                            document.getElementById("loginPassword").innerText = "";
                            document.getElementById("loginPassword").style.display = "none";
                        }
                    }
                    // Display error message for an invalid email
                    if (xhr.status === 404) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        var message = responseJSON.message;
                        var errors = responseJSON.errors;

                        alert(message);

                        // Check if the error is related to the email field
                        if (errors === 'Email not found') {
                            document.getElementById("loginEmailError").innerText = errors;
                            document.getElementById("loginEmailError").style.display = "block";
                        } else {
                            document.getElementById("loginEmailError").innerText = "";
                            document.getElementById("loginEmailError").style.display = "none";
                        }

                        // Clear the password error element as well
                        document.getElementById("loginPassword").innerText = "";
                    } else {
                        document.getElementById("loginEmailError").innerText = "";
                        document.getElementById("loginEmailError").style.display = "none";
                    }
                    // Display error message for an invalid password
                    if (xhr.status === 401) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        var message = responseJSON.message;
                        var errors = responseJSON.errors;
                        alert(message);
                        // Check if the error is related to the password field
                        if (errors) {

                            document.getElementById("loginpasswordError").innerText = errors;
                            document.getElementById("loginpasswordError").style.display = "block";
                        } else {
                            document.getElementById("loginpasswordError").innerText = "";
                            document.getElementById("loginpasswordError").style.display = "none";
                        }
                    } else {
                        document.getElementById("loginpasswordError").innerText = "";
                        document.getElementById("loginpasswordError").style.display = "none";
                    }
                    if (xhr.status === 403) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        var message = responseJSON.message;
                        var errors = responseJSON.errors;
                        alert(message);
                        // Check if the error is related to the password field
                        if (errors) {

                            document.getElementById("accountActivate").innerText = errors;
                            document.getElementById("accountActivate").style.display = "block";
                        } else {
                            document.getElementById("accountActivate").innerText = "";
                            document.getElementById("accountActivate").style.display = "none";
                        }
                    } else {
                        document.getElementById("accountActivate").innerText = "";
                        document.getElementById("accountActivate").style.display = "none";
                    }
                }
            });
        } catch (e) {
            console.error("Error sending data:", error);
            console.log(e);
        }
    }
</script>

<script>
    document.getElementById("loginBtn").addEventListener("click", function() {
        document.getElementById("loginModal").style.display = "block";
        document.getElementById("loginForm").style.display = "block";
    });

    document.getElementById("registerBtn").addEventListener("click", function() {
        document.getElementById("registerModal").style.display = "block";
        document.getElementById("registerForm").style.display = "block";
    });

    document.getElementsByClassName("close")[0].addEventListener("click", function() {
        document.getElementById("loginModal").style.display = "none";
        document.getElementById("loginForm").style.display = "none";
    });

    document.getElementsByClassName("close")[1].addEventListener("click", function() {
        document.getElementById("registerModal").style.display = "none";
        document.getElementById("registerForm").style.display = "none";
    });
</script>

<!---Aos Javascript---->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
    AOS.init();
</script>
<!---Aos Javascript-->

</html>
