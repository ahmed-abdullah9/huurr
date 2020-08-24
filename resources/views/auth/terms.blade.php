@include('include/header_guest')

<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100" style="padding-top: 50px;">
        <span class="login100-form-title" style="text-align: left;">
          Terms & Conditions
        </span>
        <span>{{$terms->terms}}</span>
      </div>
    </div>
  </div>
@include('include/footer_guest')
