@include('include/header_guest')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?php echo asset('/new-design/') ?>/images/LOGO.png" alt="IMG" style="padding-top:70px; padding-left:90px;">
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ url('/reset/password/'.$reset_token) }}">
                {{ csrf_field() }}
                <span class="login100-form-title">
            Reset Password
          </span>
                @if($errors->any())
                    <h5 style="color: #862222;">{{$errors->first()}}</h5>
                @endif
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100 input_val" type="password" id="password" name="password" required autofocus placeholder=" {{ __('auth.Password') }}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
                    <span class="error" style="margin-left: 40px;" id="password-error">{{ __('auth.errorMSGPassword') }}</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100 input_val" type="password" name="confirm" id="password_confirm" placeholder=" {{ __('auth.ConfirmPassword') }}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
                    <span class="error" style="margin-left: 40px;" id="password_confirm-error">{{ __('auth.errorMSGConfirmPassword') }}</span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Update Password
                    </button>
                </div>
                <p class="message">Do'nt have an account? <a href="{{ url('register') }}"> Sign up</a></p>
            </form>
        </div>
    </div>
</div>
@include('include/footer_guest')

