@extends('main.layouts.master')

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Liked Blogs</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="blog-container">
<div class="row">
                
    @foreach($posts as $post)
    <div class="col-md-6 col-lg-4 col-xl-4">
    <div class="blog-box">
        <div class="blog-img">
        <a href="{{route('blog.show',$post->id)}}"><img class="img-fluid" src="{{ asset('storage/'.$post->image) }}" alt="" /></a>
        </div>
        <div class="blog-content">
            <div class="title-blog">
               <a href="{{route('blog.show',$post->id)}}"><h3>{{$post->title}}</h3></a> 
                <p>{!!$post->body!!}</p>
            </div>
            <ul class="option-blog">
                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i class="far fa-heart"></i></a></li>
                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i class="fas fa-eye"></i></a></li>
                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i class="far fa-comments"></i></a></li>
            </ul>
        </div>
    </div>
</div>
    @endforeach
</div>
</div>
<!-- End All Title Box -->
    
@endsection