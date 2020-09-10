
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Ecommerce By Rabin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Bootstrap CSS -->
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@include('main.layouts.header')

@yield('content')
@include('main.layouts.footer')
@yield('qnt-js')
@yield('extra-js')



<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
    <!-- ALL JS FILES -->
<script src="{{asset('frontend_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>

    <!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <!-- ALL PLUGINS -->
    <script src="{{asset('frontend_assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('frontend_assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootsnav.js')}}"></script>
    <script src="{{asset('frontend_assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('frontend_assets/js/custom.js')}}"></script>
    <script src="{{asset('frontend_assets/js/checkout-stripe.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>