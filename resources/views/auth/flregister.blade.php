@extends('layouts.app')

@section('content')
<div class="login-section register-section">
<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="{{ url('register') }}">
    {{ csrf_field() }}
    <div class="hide_form">
	   <h2>Sign Up</h2>
      <input type="hidden" name="user_role" value="freelancer">
      <span class="error" id="first_name-error">First Name Is Required</span>
      <input type="text" id="first_name" class="input_val" name="name" value="{{ old('name') }}" placeholder="First Name" required />
      <span class="error" id="last_name-error">Last Name Is Required</span>
      <input type="text" id="last_name" name="last_name" class="input_val" value="{{ old('last_name') }}" placeholder="Last Name" required />
      <span class="error" id="email-error">Email Is Required</span>
      <input type="email" placeholder="Email" id="email" class="input_val" name="email" value="{{ old('email') }}" required />
      <span class="error" id="password-error">Password Is Required</span>
      <input type="password" id="password" class="input_val" name="password" placeholder="Password" required />
      <span class="error" id="password_confirm-error">Confirm Password Is Required</span>
      <input id="password_confirm" type="password" class="input_val" name="password_confirmation" placeholder="Confirm Password" required>  
    </div>
      <span class="error" id="common-error"></span>   
      <button type="button" class="start_registration">Get Started</button>
    
    </form>
  </div>
</div>
</div>

@endsection
