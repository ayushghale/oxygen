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
            console.log('select user type');
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
            url: "{{ route('registerUser') }}", // Replace this with the URL of your server endpoint
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
            url: "{{ route('loginUser') }}", // Replace this with the URL of your server endpoint
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
                        document.getElementById("loginEmail").innerText = errors.email[0];
                        document.getElementById("loginEmail").style.display = "block";
                    } else {
                        document.getElementById("loginEmail").innerText = "";
                        document.getElementById("loginEmail").style.display = "none";
                    }

                    // Password error
                    if (errors.password) {
                        document.getElementById("loginPassword").innerText = errors.password[0];
                        document.getElementById("loginPassword").style.display = "block";
                    } else {
                        document.getElementById("loginPassword").innerText = "";
                        document.getElementById("loginPassword").style.display = "none";
                    }
                }
                else{
                    document.getElementById("loginEmail").innerText = "";
                    document.getElementById("loginEmail").style.display = "none";
                    document.getElementById("loginPassword").innerText = "";
                    document.getElementById("loginPassword").style.display = "none";
                }
                // Display error message for an invalid email
                if (xhr.status === 404) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    var message = responseJSON.message;
                    var errors = responseJSON.errors;


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
                    console.log(message);
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
                    console.log(message);
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