@include('include/header_guest') 
<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <figure>
          <img src="<?php echo asset('/new-design/') ?>/images/LOGO.png" alt="IMG" style="padding-top:70px; padding-left:90px;">
            <figcaption  style="color:#390E0E;text-align: center;justify-content: center;padding-top: 17px;font-family:GE-SS-TWO-BOLD !important;">
              {{__('auth.huurr_moto')}}
            </figcaption>
          </figure>
        </div>

        <form class="login100-form validate-form" method="POST" action="{{ url('login') }}">
          {{ csrf_field() }}
          <span class="login100-form-title">
            {{ __('auth.MemmberLogin') }}
          </span>
          @if($errors->any())
            <h5 style="color: #862222;">{{$errors->first()}}</h5>
          @endif
          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="{{ __('auth.Email') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="{{ __('auth.Password') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
            
              {{ __('auth.Login') }}
            </button>
          </div>

          <div class="text-center p-t-12">
            <a class="txt2" href="{{ url('forget/password') }}">
              {{ __('auth.email/password') }}
            </a>
          </div>

          <div class="text-center p-t-136">
            <a class="txt2" href="{{ url('register') }}">
              {{ __('auth.createAccount') }}
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('include/footer_guest') 