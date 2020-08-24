@extends('layouts.app')

@section('content')
<div class="login-section register-section">
<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
	<h2>Reset your password</h2>
	<p>Username or Email</p>
      <input type="text" placeholder=""/>
	  <button>Send Reset Email</button>
    
    </form>
  </div>
</div>
</div>
@endsection
