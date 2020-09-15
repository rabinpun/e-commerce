@extends('main.layouts.master')

@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">{{$post->title}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="blog-container">
    <div class="">
    <div class="blog-box d-flex">
        <div class="blog-img">
            <div class="blog-title">{{$post->title}}</div>
            <img class="img-fluid blog-image" src="{{ asset('storage/'.$post->image) }}" alt="" />
            <ul class="options-blog d-flex">

                {{-- if the post is in the liked post pivot table the like button is active --}}
                {{-- href="{{route('blog.like',$post->id)}}"  --}}

            <li id="listlike" class={{$like?"options-blog-active":"options-blog-inactive"}}  ><a id="like"  blog-id={{$post->id}}  data-toggle="tooltip" data-placement="right" title="Likes"><i  class="far fa-heart"></i></a></li>
                <li class="options-blog-inactive"><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i class="fas fa-eye"></i></a></li>
                <li class="options-blog-inactive"><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i class="far fa-comments"></i></a></li>
            </ul>
        </div>
        
        
        <div class="blog-content">
            <div class="blog-body">
                
                <p>{!!$post->body!!}</p>
            </div>
            
        </div>
    </div>
</div>
</div>

<!-- End All Title Box -->
    
@endsection

@section('extra-js')
<script>
    // function like(){
            
    //         var element=document.getElementById('like');
    //         var id=element.getAttribute('blog-id');
    //         //axios.get(route('blog.like',))
    //     };
        (function(){
            $("#like").click(()=>{
                var id=($("#like").attr('blog-id'))
                axios.get(`/blogs/like/${id}`)
                .then(function (response) {
                    if($('#listlike').hasClass('options-blog-active')){
                                    $('#listlike').removeClass('options-blog-active');
                                    $('#listlike').addClass('options-blog-inactive');
                                }
                                else{
                                    $('#listlike').removeClass('options-blog-inactive');
                                    $('#listlike').addClass('options-blog-active');
                                }
                            });
                
                                
                
            });
        })();
</script>
@endsection