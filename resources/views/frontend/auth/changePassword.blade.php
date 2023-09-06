@include('frontend.include.header')

<!----Logo Navbar Starts Here-->
@include('frontend.include.navbar')

<div class="container" style="display: flex; justify-content: center; margin-top: 20px;margin-bottom: 20px;">
    <div class="login-input forget-password">
        <h2>Forget Your Password?</h2>
        <form action="{{ route('user.resetPasswordData') }}" method="POST">
            @csrf
            <div class="inp-cont">
                <div class="label-container">
                    <label for="">Enter New Password :</label>
                </div>

                <input type="password" placeholder="Enter New Password" name="password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="inp-cont">
                <div class="label-container">
                    <label for="">Confirm Your Password :</label>
                </div>

                <input type="password" placeholder="Confirm Password" name="conform_password">
                @error('conform_password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button class="modal-button">Next <i class="fa-solid fa-arrow-right"></i></button>
        </form>
    </div>

</div>

@include('frontend.include.footer')
