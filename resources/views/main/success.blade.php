@extends('main.layouts.master')

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Thank You</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div style="height: 50vh;margin-top:90px;margin-left:250px;margin-right:250px;margin-bottom:50px;text-align:center;border:2px solid black;">
    <br><br>
    <h1 style="font-size: 40px" class="alert alert-success"><strong>Thank You for the Order</strong></h1>
    <h3>Your Payment was successful. We will contact you soon!!!</h3>
    <button class="btn-lg btn-secondary">Home Page</button>
</div>

<!-- End All Title Box -->
    
@endsection