@if(session()->has('success_message'))
                        <div class="alert alert-success">{{session('success_message')}}</div>
@endif

@if(session()->has('cardfail'))
                        <div class="alert alert-danger" style="text-align: center"  >{{session('cardfail')}}</div>
@endif

@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger"><li>{!!$error!!}</li></div> <!--so that the html in errors msg can be parsed to create login anchortag when guest uses a registered account as email address-->
    @endforeach
@endif