@include('frontend.include.header')

<!----Logo Navbar Starts Here-->
@include('frontend.include.navbar')

<!---Logo Navbar Ends Here-->

{{-- forget password form --}}
<div class="container" style="display: flex; justify-content: center; margin-top: 20px;margin-bottom: 20px;">


    <div class="login-input forget-password">
        <h2>OTP Code</h2>
        <p class="change-para">Enter Code And Change Password.</p>
        <form action="{{ route('user.resetPasswordOtpData') }}" method="POST">
            @csrf
            <div class="inp-cont">
                <div class="label-container">
                    <label for="">Enter OTP Code :</label>
                </div>
                <div class="otp-container">
                    {{-- <form action="{{  }}"></form> --}}
                    <input type="text" placeholder="*" id="0" maxlength="1" class="otp" name="first">
                    <input type="text" placeholder="*" id="1" maxlength="1" class="otp" name="second">
                    <input type="text" placeholder="*" id="2" maxlength="1" class="otp" name="third">
                    <input type="text" placeholder="*" id="3" maxlength="1" class="otp" name="fourth">

                </div>
            </div>
            <button class="modal-button">Next <i class="fa-solid fa-arrow-right"></i></button>
        </form>
    </div>

</div>

<!--footer starts here-->

<!--footer starts here-->

@include('frontend.include.footer')
