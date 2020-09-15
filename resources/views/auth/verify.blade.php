@extends('main.layouts.master')

@section('content')


<div class="container">
    <div class="center-container">
        <h2 class="login-left-title center">Verifiy your Email.</h2>
        <div class="spacer-small"></div>
        <p>Before proceeding, please check your email for a verification link.</p>
        <div class="spacer-small"></div>
        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="login-btnreset">{{ __('click here to request another') }}</button>.
        </form>
       


      
</div>
</div>
@endsection
