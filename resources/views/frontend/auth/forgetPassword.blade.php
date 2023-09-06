@include('frontend.include.header')

<!----Logo Navbar Starts Here-->
@include('frontend.include.navbar')

<!---Logo Navbar Ends Here-->


{{-- forget password form --}}
<div class="container" style="display: flex; justify-content: center; margin-top: 20px;margin-bottom: 20px;">
    <div class="login-input forget-password">
        <h2>Forget Your Password?</h2>
        <p class="change-para">You Can Change Your Password Here.</p>
        <form action="{{ route('user.forgetPasswordData') }}" method="POST">
            @csrf
            <div class="inp-cont">
                <div class="label-container">
                    <label for="">Enter Your Email :</label>
                </div>

                <input type="text" placeholder="Enter Your Email" name="email">
                @error('email')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button class="modal-button">Next <i class="fa-solid fa-arrow-right"></i></button>
        </form>
    </div>
</div>

<!--footer starts here-->

@include('frontend.include.footer')
