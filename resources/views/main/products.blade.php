@extends('main.layouts.master')
@section('content')
    
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Products</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('main.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

  

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            @if(session()->has('success_message'))
                        <div class="alert alert-success">{{session('success_message')}}</div>
                @endif
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                       <div class="alert alert-danger"><li>{{$error}}</li></div> 
                    @endforeach
                @endif
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>  
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1" style="font-size:1.5rem">Electronics<small class="text-muted">({{$totalcount}})</small>
								</a>
                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">
                                            @foreach ($categories as $category)
                                        <a style="{{request()->category == $category->slug ? 'color:black;font-size:1.5rem' :'' }}" href="{{route('products.index',['category'=>$category->slug])}}" class="list-group-item list-group-item-action active">{{$category->name}}<small class="text-muted"></small></a>
                                        <!--if the category slug and requested category is same then the color is black    -->
                                        @endforeach
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Footwear 
								<small class="text-muted">(50)</small>
								</a>
                                    <div class="collapse" id="sub-men2" data-parent="#list-group-men">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">Sports Shoes <small class="text-muted">(10)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Sneakers <small class="text-muted">(20)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Formal Shoes <small class="text-muted">(20)</small></a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="list-group-item list-group-item-action"> Men  <small class="text-muted">(150) </small></a>
                                <a href="#" class="list-group-item list-group-item-action">Accessories <small class="text-muted">(11)</small></a>
                                <a href="#" class="list-group-item list-group-item-action">Bags <small class="text-muted">(22)</small></a>
                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                    <button class="btn hvr-hover" type="submit">Filter</button>
                                </p>
                            </div>
                        </div>
                        <div class="filter-brand-left">
                            <div class="title-left">
                                <h3>Brand</h3>
                            </div>
                            <div class="brand-box">
                                <ul>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios1" value="Yes" type="radio">
                                            <label for="Radios1"> Supreme </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios2" value="No" type="radio">
                                            <label for="Radios2"> A Bathing Ape </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios3" value="declater" type="radio">
                                            <label for="Radios3"> The Hundreds </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios4" value="declater" type="radio">
                                            <label for="Radios4"> Alife </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios5" value="declater" type="radio">
                                            <label for="Radios5"> Neighborhood </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios6" value="declater" type="radio">
                                            <label for="Radios6"> CLOT </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios7" value="declater" type="radio">
                                            <label for="Radios7"> Acapulco Gold </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios8" value="declater" type="radio">
                                            <label for="Radios8"> UNDFTD </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios9" value="declater" type="radio">
                                            <label for="Radios9"> Mighty Healthy </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio radio-danger">
                                            <input name="survey" id="Radios10" value="declater" type="radio">
                                            <label for="Radios10"> Fiberops </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                
                                <div class="dropdown">
                                    <button class="btn  dropdown-toggle" style="color: rgb(138, 157, 192)" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                      Sort By
                                    </button>
                                   
                                    
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('products.index',['category'=>request()->category,'sort'=>'low_high'])}}">Cheapest</a>
                                    <a class="dropdown-item" href="{{route('products.index',['category'=>request()->category,'sort'=>'high_low'])}}">Most Expensive</a>
                                  </div>
                                  </div>
                                 
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a 
                                        @if($view==0) 
                                        class="nav-link active"
                                        @else
                                        class="nav-link"
                                        @endif
                                         href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                    <a 
                                    @if($view==1) 
                                    class="nav-link active"
                                    @else
                                    class="nav-link"
                                    @endif
                                    href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                            <h1><strong>{{$categoryName}}: Showing  {{count($products)}} products from {{$countno}} products.</strong></h1>
                                <div role="tabpanel" 
                                @if($view==0) 
                                class="tab-pane fade show active" 
                                @else
                                class="tab-pane fade" 
                                @endif
                                id="grid-view">
                                    <div class="row">
                                        @forelse ($products as $product)
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">
                                                        
                                                            @if($product->quantity>5)
                                                                In Stock
                                                            @elseif($product->quantity<5&&$product->quantity>0)
                                                                Low in Stock
                                                            @else
                                                                Out of Stock
                                                            @endif
                                                        
                                                        </p>
                                                    </div>
                                                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="Image" >
                                                    <div class="mask-icon"  >
                                                        <ul>
                                                            <li><a href="{{route('products.show',$product->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            {{-- <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li> --}}
                                                        {{-- <li><form action="{{route('wishlist.store')}}" method="POST">@csrf <input type="hidden" name="id" value="{{$product->id}}"> <input type="hidden" name="name" value="{{$product->name}}"> <input type="hidden" name="price" value="{{$product->price}}"> <a href="" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"><button type="submit">ss</button></i></a></form></li> --}}
                                                             <li> <a href="{{route('wishlist.store',$product)}}" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>
                                                        <li><form action="{{route('cart.store')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$product->id}}" name="id">
                                                            <input type="hidden" value="{{$product->name}}" name="name">
                                                            <input type="hidden" value={{$product->price}} name="price">
                                                            <button class="btn hvr-hover " type="submit" style="color: white"> Add to Cart </button>
                                                        </form></li>
                                                    
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                <a href="{{route('products.show',$product->slug)}}"><h5>{{$product->name}}</h5><br></a>
                                                    <h4>{{$product->details}}<br>
                                                    {{\Illuminate\Support\Str::limit($product->description, 50)}}</h4>
                                                    {{--this works no more in new laravel versions <h4>{{str_limit($product->description,10)}}</h4> --}}
                                                    <h5>Rs. {{$product->price}}.00</h5>
                                                </div>
                                            </div>
                                           
                                        </div> 
                                        @empty
                                        <h1 style="margin-left: 5rem">No items found</h1>

                                        @endforelse
                                        {{-- sending view = grid for grid view so that we can load next page in same view grid or list. we will check view is grid or list in controller@index and send view 0 for grid and 1 for list so we can load view in same way --}}
                                         {{$products->appends(request()->input())->appends(['view'=>'grid'])->links()}}  {{-- creating the pagination link --}}
                                        
                                    </div>
                                </div>
                                <div role="tabpanel"
                                @if($view==1) 
                                class="tab-pane fade show active" 
                                @else
                                class="tab-pane fade" 
                                @endif
                                 
                                 id="list-view">
                                    <div class="list-view-box">
                                        @forelse($products as $product)
                                        <div class="row">
                                            
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                               
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="new">@if($product->quantity>5)
                                                                In Stock
                                                            @elseif($product->quantity<5&&$product->quantity>0)
                                                                Low in Stock
                                                            @else
                                                                Out of Stock
                                                            @endif</p>
                                                        </div>
                                                        <img src="{{asset('Storage/'.$product->image)}}" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                            <li><a href="{{route('products.show',$product->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                {{-- <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li> --}}
                                                                {{-- <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li> --}}
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <a href="{{route('products.show',$product->slug)}}"><h4>{{$product->name}}</h4></a>
                                                    <h5> <del>{{$product->previousPrice()}}</del> {{$product->price}}</h5>
                                                    <p> {{$product->description}}</p>
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn hvr-hover "  ><form action="{{route('cart.store')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$product->id}}" name="id">
                                                                <input type="hidden" value="{{$product->name}}" name="name">
                                                                <input type="hidden" value={{$product->price}} name="price">
                                                                <button type="submit" style="font-size:1rem;font-weight:bold;background-color:Transparent;border:none;color:white"> Add to Cart </button>
                                                            </form></a>
                                                            <a class="btn hvr-hover" href="{{route('wishlist.store',$product)}}">Add to Wishlist</a>
                                                        </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <h1 style="margin-left: 5rem">No items found</h1>
                                        @endforelse
                                        
                                    </div>
                                    {{$products->appends(request()->input())->appends(['view'=>'list'])->links()}}

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->


    @endsection