@extends('main.layouts.master')

@section('content')
<div class="container">
    <div class="center-container">
        <h2 class="login-left-title center">Forgot password? </h2>
        <div class="spacer-small"></div>
        <p>No worrries. Retrieve your account in few clicks.</p>
        <div class="spacer-small"></div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-box" >
            <i class="fas fa-envelope icon-login" ><div class="icon-bg"></div></i>

            
                <input  id="email" placeholder="     Email" type="email" class="input-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                   <br> <span class="error-msg" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
                <button type="submit" class="login-btnreset">
                    {{ __('Send Password Reset Link') }}
                </button>
            
        
        </form>


      
</div>
</div>
@endsection
