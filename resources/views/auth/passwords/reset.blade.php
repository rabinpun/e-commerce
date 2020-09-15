@extends('main.layouts.master')

@section('content')
<div class="container">


    <div class="center-container">
        <h2 class="login-left-title center">Forgot password? </h2>
        <div class="spacer-small"></div>
        <p>No worrries. Retrieve your account in few clicks.</p>
        <div class="spacer-small"></div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-box" >
            <i class="fas fa-envelope icon-login" ><div class="icon-bg"></div></i>
            
            
            <input id="email" placeholder="     Email"  type="email" class="input-center @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="input-box">
                <i class="fa fa-eye-slash icon-login" aria-hidden="true"><div class="icon-bg"></div></i>
                <input id="password" type="password" placeholder="     Password" class="input-center @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-box">
                <i class="fa fa-eye-slash icon-login" aria-hidden="true"><div class="icon-bg"></div></i>
                <input id="password-confirm" placeholder="     Confirm Password" type="password" class="input-center" name="password_confirmation" required autocomplete="new-password">
            </div>


            
                <button type="submit" class="login-btnreset">
                    {{ __('Reset Password') }}
                </button>
            
        
        </form>


      
</div>




   
@endsection
