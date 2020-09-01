@extends('main.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
    </div>
</div>
@endsection

@section('extra-js')
<script>
   
        document.querySelector('#loginform').addEventListener('submit',function (e){
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
                firstItemDom.insertAdjacentHTML('afterend',`<div class= "text-danger">${firstItemErrorMsg}</div>`)

                //remove previous border highlight
                const formControl = document.querySelectorAll('.form-control');
                formControl.forEach(function(element){
                    element.classList.remove('border-danger');
                })

                //add border highlight for the error input field
                firstItemDom.classList.add('border-danger');
   
            })
        
        // axios.post(this.action,{
        //         'name':document.querySelector('#name').value,
        //         'email':document.querySelector('#email').value,  // # is id and . is class
        //         'password':document.querySelector('#password').value
        //         'passwordconfirm':document.querySelector('#email').value,
        //     })
        //     .then(function (response) {
        //         alert('yes');
        //     })
        //     .catch(function (error) {
        //         //console.log(error.response.data.errors);
        //         const errors= error.response.data.errors;
        //         const firstItem = Object.keys(errors)[0];// cant just use firstitem = errors[0] coz the error an object of arrays {xyz:"asdasd",efe="asdassa"} Object.keys will convert object into array
        //         //firstitemdom is the document object where we can attach the error message on the bottom              
        //         const firstItemDom = document.querySelector(`#${firstItem}`);
        //         const firstItemErrorMsg = errors[firstItem][0]; //for name errors[name][since there is only on error msg so 0 is the first msg]  for password errors[password][0]
                
        //         //scroll to the error msg
        //         firstItemDom.scrollIntoView();//scroll to the error dom elemnt for beter user experience
        //         window.scrollBy(0, -300); //due to the div position the scroll may not be on the exact position we want so we are offsettign the mis alignment

        //         //remove the previous error msgs as refresh does for new input since there is no refresh and the html stays there and we remove it manually
        //         const errorMsgs = document.querySelectorAll('.text-danger'); //since all the error msgs will have class="text-danger"
        //         errorMsgs.forEach(function(element){
        //             element.textContent='';//making the error msg text blank
        //         })
                
        //         //show the error msg right below the input box dom element insertAdjacentHtml inserts html next to it
        //         firstItemDom.insertAdjacentHTML('afterend',`<div class= "text-danger">${firstItemErrorMsg}</div>`)

        //         //remove previous border highlight
        //         const formControl = document.querySelectorAll('.form-control');
        //         formControl.forEach(function(element){
        //             element.classList.remove('border-danger');
        //         })

        //         //add border highlight for the error input field
        //         firstItemDom.classList.add('border-danger');
   
            
        //     })

})
</script>


@endsection
