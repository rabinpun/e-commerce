@extends('main.layouts.master')

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-left">
            <h2 class="login-left-title">Returning Customer</h2>
            <div class="spacer"></div>
            <form id="login-form" action="{{ route('register') }}" method="POST">
                @csrf
                <div  style="position: relative">
                    <i class="fas fa-user icon-login" ><div class="icon-bg"></div></i><input id="name" type="text" placeholder="    Name" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                </div>
                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <div  style="position: relative">
                    <i class="fas fa-envelope icon-login" ><div class="icon-bg"></div></i><input id="email" placeholder="    Email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                </div>
                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <div  style="position: relative">
                <i class="fa fa-eye-slash icon-login" aria-hidden="true"><div class="icon-bg"></div></i><!--this div is also absolute and is the backgorund-->
                <input id="password" type="password" class="input @error('password') is-invalid @enderror" placeholder="    Password" name="password"  autocomplete="new-password">
                </div>   
                 
                <div  style="position: relative">
                    <i class="fa fa-eye-slash icon-login" aria-hidden="true"><div class="icon-bg"></div></i><!--this div is also absolute and is the backgorund-->
                    <input class="input" type="password" name="password" id="passwordconfirm" placeholder="    Confirm Password" required autofocus>
                    </div> 
            
            <div class="login-btn-container">
                <button class="login-btn" type="submit" value="submit">Register</button>
            </div>
        
            <div class="spacer"></div>
        </form>
            </div> 
        <div class="login-right">
            <h2 class="login-right-title">New Customer</h2>
            <div class="spacer-small"></div>
            <p>
            <strong>Save time for now.</strong></p>
            <p>You dont need to login to buy our products.</p>
            @if(count(Cart::content())>0)
                <!--so that when a user trys to first login he doesnt see checkout as guest checkout as guest is only seen when a guest is trying to checkout or a guest uses email that is already registered and moved to login page-->
                @if(session()->has('paymentesewa'))
                <a  class="login-btn" href="{{route('checkoutes.index')}}">Check Out as Guest</a>
                @else

                    <a   class="login-btng btn" href="{{route('guestcheckout.index')}}">Check Out as Guest</a>
                @endif
                <!--If user has no item in cart we dont wanna show checkout as guest so we add option for them to browse as guest-->
                @else
                <a   class="login-btng btn" href="{{route('products.index')}}">Continue as Guest</a>
                @endif
                <hr>

        <div class="spacer"></div>

                <p>
                    <strong>Already have an account?</strong></p>
                    <p>If you have forgot your password got to login as click forgot password.</p>
                    <div class="spacer-small"></div>
                    <a   class="login-btng btn" href="{{route('login')}}">Login</a>
            </div> 
    </div>
    
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="loginform" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('extra-js')
<script>
   
        document.querySelector('#login-form').addEventListener('submit',function (e){
        e.preventDefault();
        axios.post(this.action,{
                'name':document.querySelector('#name').value,
                'email':document.querySelector('#email').value,  // # is id and . is class
                'password':document.querySelector('#password').value,
                'password_confirmation':document.querySelector('#passwordconfirm').value,
            })
            .then(function (response) {
                window.location.href='/';
            })
            .catch(function (error) {
                
                 console.log(error.response.data.errors);
                const errors= error.response.data.errors;
                const firstItem = Object.keys(errors)[0];// cant just use firstitem = errors[0] coz the error an object of arrays {xyz:"asdasd",efe="asdassa"} Object.keys will convert object into array
                //firstitemdom is the document object where we can attach the error message on the bottom              
                const firstItemDom = document.querySelector(`#${firstItem}`);
                const firstItemErrorMsg = errors[firstItem][0]; //for name errors[name][since there is only on error msg so 0 is the first msg]  for password errors[password][0]
                
                //scroll to the error msg
                firstItemDom.scrollIntoView();//scroll to the error dom elemnt for beter user experience
                window.scrollBy(0, -300); //due to the div position the scroll may not be on the exact position we want so we are offsettign the mis alignment

                //remove the previous error msgs as refresh does for new input since there is no refresh and the html stays there and we remove it manually
                const errorMsgs = document.querySelectorAll('.text-danger'); //since all the error msgs will have class="text-danger"
                errorMsgs.forEach(function(element){
                    element.textContent='';//making the error msg text blank
                })
                //show the error msg right below the input box dom element insertAdjacentHtml inserts html next to it
                firstItemDom.insertAdjacentHTML('afterend',`<span style="position:absolute;margin-top:-1.5rem;margin-left:-31rem; width:100%" class= "text-danger">${firstItemErrorMsg}</span>`)

                //remove previous border highlight
                const formControl = document.querySelectorAll('.form-control');
                formControl.forEach(function(element){
                    element.classList.remove('border-danger');
                })

                //add border highlight for the error input field
                firstItemDom.classList.add('border-danger');
   
            })
        
        

})
</script>


@endsection
