@extends('frontend.layouts.master')
@section('title','HOME PAGE')
@section('main-content')

@if(count($banners)>0)
<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3  section-bg-1">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
        <!-- ltn__slide-item -->
        @foreach($banners as $key=>$banner)
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal bg-image" data-bg="{{asset('assets/images/banner/'.$banner->photo)}}">
            <div class="ltn__slide-item-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <div class="slide-video mb-50 d-none">
                                        {{-- <a class="ltn__video-icon-2 ltn__video-icon-2-border" href="https://www.youtube.com/embed/ATI7vfCgwXE?autoplay=1&showinfo=0" data-rel="lightcase:myCollection">
                                            <i class="fa fa-play"></i>
                                        </a> --}}
                                    </div>
                                    <h6 class="slide-sub-title animated"><img src="{{asset('frontend/assets/img/icons/icon-img/1.png')}}" alt="#"> 100% Naturel</h6>
                                    <h1 class="slide-title animated "><?php echo $banner->title ?></h1>
                                    <div class="slide-brief animated">
                                        <p>{!! html_entity_decode($banner->description) !!}</p>
                                    </div>
                                    <div class="btn-wrapper animated">
                                        <a href="{{route('product-grids')}}" class="theme-btn-1 btn btn-effect-1 text-uppercase">Voir Plus</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="slide-item-img">
                                <img src="img/slider/21.png" alt="#">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!--  -->
    </div>
</div>
<!-- SLIDER AREA END -->
@endif

<!-- FEATURE AREA START ( Feature - 3) -->
<div class="ltn__feature-area mt-100 mt--65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border section-bg-6">
                    @php
                    $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
                    @endphp
                    @if($category_lists)
                        @foreach($category_lists as $cat)
                            @if($cat->is_parent==1)
                                <div class="ltn__feature-item ltn__feature-item-8">
                                    <div class="ltn__feature-icon">
                                        @if($cat->photo)
                                            <img src="{{asset('assets/images/'.$cat->photo)}}" alt="{{$cat->photo}}">
                                        @else
                                            <img src="https://via.placeholder.com/600x370" alt="#">
                                        @endif
                                    </div>
                                    <div class="ltn__feature-info">
                                        <h4>{{$cat->title}}</h4>
                                        <p><a href="{{route('product-cat',$cat->slug)}}">Découvrir</a></p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

<!-- PRODUCT TAB AREA START (product-item-3) -->
<div class="ltn__product-tab-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Nos Produits</h1>
                </div>
                <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                    <div class="nav">
                        @php
                            $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                            $minID = DB::table('categories')->where('status','active')->where('is_parent',1)->select('id')->min('id');
                            // dd($categories);
                        @endphp
                        @if($categories)
                            @foreach($categories as $key=>$cat)
                                <a data-toggle="tab" class="{{ $cat->id==$minID ? 'active show' : '' }}" href="#liton_tab_3_{{$cat->id}}">{{$cat->title}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="tab-content">
                    @if($productsArea)
                        @foreach($productsArea as $item)
                            <div class="tab-pane fade {{ $item->id==$minID ? 'active show' : '' }}" id="liton_tab_3_{{$item->id}}">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        @foreach($item->products as $product)
                                            <!-- ltn__product-item -->
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        <a href="{{route('product-detail',$product->slug)}}">
                                                            @php
                                                                $photo=explode(',',$product->photo);
                                                            @endphp
                                                            <img src="{{ asset('/assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                        </a>
                                                        <div class="product-badge">
                                                            <ul>
                                                                @if($product->stock<=0)
                                                                    <li class="sale-badge">Soldé</li>
                                                                @else
                                                                    <li class="sale-badge">{{$product->condition}}</li>
                                                                    <li class="sale-badge">{{$product->discount}}%</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal{{$product->id}}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{route('add-to-cart',$product->slug)}}" title="Add to Cart">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{route('add-to-wishlist',$product->slug)}}" title="Wishlist">
                                                                        <i class="far fa-heart"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        {{-- <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                <li class="review-total"> <a href="#"> (24)</a></li>
                                                            </ul>
                                                        </div> --}}
                                                        <h2 class="product-title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h2>
                                                        <div class="product-price">
                                                            @php
                                                                $settings=DB::table('settings')->get();
                                                                $after_discount=($product->price-($product->price*$product->discount)/100);
                                                            @endphp
                                                            <span>{{number_format($after_discount,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</span>
                                                            <del style="padding-left:4%;">{{number_format($product->price,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT TAB AREA END -->

<!-- COUNTER UP AREA START -->
<div class="ltn__counterup-area bg-image bg-overlay-theme-black-80 pt-115 pb-70" data-bg="img/bg/5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{asset('frontend/assets/img/icons/icon-img/2.png')}}" alt="#"> </div>
                    <h1><span class="counter">733</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Active Clients</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{asset('frontend/assets/img/icons/icon-img/3.png')}}" alt="#"> </div>
                    <h1><span class="counter">33</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Cup Of Coffee</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{asset('frontend/assets/img/icons/icon-img/4.png')}}" alt="#"> </div>
                    <h1><span class="counter">100</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Get Rewards</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{asset('frontend/assets/img/icons/icon-img/5.png')}}" alt="#"> </div>
                    <h1><span class="counter">21</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Country Cover</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- COUNTER UP AREA END -->

<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Produits phare</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
            @if($featured)
                @foreach($featured as $data)
                    <!-- ltn__product-item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 text-left">
                            <div class="product-img">
                                @php
                                    $photo=explode(',',$data->photo);
                                @endphp
                                <a href="{{route('product-detail',$data->slug)}}"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}"></a>
                                <div class="product-badge">
                                    <ul>
                                        @if($product->stock<=0)
                                            <li class="sale-badge">Soldé</li>
                                        @else
                                            <li class="sale-badge">{{$product->condition}}</li>
                                            <li class="sale-badge">{{$product->discount}}%</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal{{$data->id}}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('add-to-cart',$data->slug)}}" title="Add to Cart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('add-to-wishlist',$data->slug)}}" title="Wishlist">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                {{-- <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div> --}}
                                <h2 class="product-title"><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h2>
                                @php
                                    $after_discount=($data->price-($data->price*$data->discount)/100);
                                @endphp
                                <div class="product-price">
                                    <span>{{number_format($after_discount,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</span>
                                    <del>{{number_format($data->price,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</del>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->

<!-- CALL TO ACTION START (call-to-action-4) -->
<div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image pt-115 pb-120" data-bg="{{asset('frontend/assets/img/bg/6.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-4 text-center">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">//  Si vous avez des questions  //</h6>
                        <h1 class="section-title white-color">@foreach($settings as $datas) {{ $datas->phone }} @endforeach</h1>
                    </div>
                    <div class="btn-wrapper">
                        <a href="tel:@foreach($settings as $datas) {{ $datas->phone }} @endforeach" class="theme-btn-1 btn btn-effect-1">PASSER UN APPEL</a>
                        <a href="{{route('contact')}}" class="btn btn-transparent btn-effect-4 white-color">CONTACTER NOUS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__call-to-4-img-1">
        <img src="{{asset('frontend/assets/img/bg/12.png')}}" alt="#">
    </div>
    <div class="ltn__call-to-4-img-2">
        <img src="{{asset('frontend/assets/img/bg/11.png')}}" alt="#">
    </div>
</div>
<!-- CALL TO ACTION END -->

<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pt-80 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title">Dernier Articles</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__product-slider-item-four-active slick-arrow-1">
            @php
                $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
            @endphp
            @foreach($product_lists as $product)
                <!-- ltn__product-item -->
                <div class="col-lg-12">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="{{route('product-detail',$data->slug)}}">
                                @php
                                    $photo=explode(',',$product->photo);
                                @endphp
                                <img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}">
                            </a>
                            <div class="product-badge">
                                <ul>
                                    @if($product->stock<=0)
                                        <li class="sale-badge">Soldé</li>
                                    @else
                                        <li class="sale-badge">{{$product->condition}}</li>
                                        <li class="sale-badge">{{$product->discount}}%</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal{{$product->id}}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('add-to-cart',$data->slug)}}" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('add-to-wishlist',$data->slug)}}" title="Wishlist">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            {{-- <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div> --}}
                            <h2 class="product-title"><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h2>
                            @php
                                $settings=DB::table('settings')->get();
                                $after_discount=($data->price-($data->price*$data->discount)/100);
                            @endphp
                            <div class="product-price">
                                <span>{{number_format($after_discount,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</span>
                                <del>{{number_format($data->price,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            @endforeach
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->

<!-- BLOG AREA START (blog-3) -->
<div class="ltn__blog-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">Dernier blog</h1>
                </div>
            </div>
        </div>
        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            @if($posts)
                @foreach($posts as $post)
                    <!-- Blog Item -->
                    <div class="col-lg-12">
                        <div class="ltn__blog-item ltn__blog-item-3">
                            <div class="ltn__blog-img">
                                <a href="{{route('blog.detail',$post->slug)}}"><img src="{{asset('assets/images/post/'.$post->photo)}}" alt="{{$post->photo}}"></a>
                            </div>
                            <div class="ltn__blog-brief">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="ltn__blog-title"><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h3>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        <ul>
                                            <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{$post->created_at->format('d M , Y. D')}}</li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a href="{{route('blog.detail',$post->slug)}}">Lire plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- BLOG AREA END -->

<!-- MODAL AREA START (Quick View Modal) -->
@if($product_lists)
    @foreach($product_lists as $key=>$product)
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_modal{{$product->id}}" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-img">
                                            @php
                                                $photo=explode(',',$product->photo);
                                            @endphp
                                            @foreach($photo as $data)
                                                <img src="{{asset('assets/images/product/'.$data)}}" alt="{{$data}}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        @else
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        @endif
                                                    @endfor
                                                    <li class="review-total"> <a href="#"> ( {{$rate_count}} Reviews )</a></li>
                                                </ul>
                                            </div>
                                            <h3>{{$product->title}}</h3>
                                            <div class="product-price">
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <span>{{number_format($after_discount,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</span>
                                                <del>{{number_format($product->price,2)}} @foreach($settings as $datas) {{ $datas->currency }} @endforeach</del>
                                            </div>
                                            <div class="modal-product-meta ltn__product-details-menu-1">
                                                <p>{!! html_entity_decode($product->summary) !!}</p>
                                            </div>
                                            <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                                @csrf
                                                <div class="ltn__product-details-menu-2">
                                                    <ul>
                                                        <li>
                                                            <div class="cart-plus-minus">
                                                                <input type="hidden" name="slug" value="{{$product->slug}}">
                                                                <input type="text" value="1" name="quant[1]" data-min="1" data-max="1000" class="cart-plus-minus-box">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                                <span><button type="submit">Ajouter au panier</button></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ltn__product-details-menu-3">
                                                    <ul>
                                                        <li>
                                                            <a href="{{route('add-to-wishlist',$product->slug)}}" class="" title="Wishlist">
                                                                <i class="far fa-heart"></i>
                                                                <span>Ajouter aux envies</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                            <hr>
                                            <div class="ltn__social-media">
                                                <ul>
                                                    <li>Partager:</li>
                                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
<!-- MODAL AREA END -->
@endsection



@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							// document.location.href=document.location.href;
						});
					}
                    else{
                        window.location.href='user/login'
                    }
                }
            })
        });
    </script> --}}
    {{-- <script>
        $('.wishlist').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            // alert(pro_id);
            $.ajax({
                url:"{{route('add-to-wishlist')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id,
                },
                success:function(response){
                    if(typeof(response)!='object'){
                        response=$.parseJSON(response);
                    }
                    if(response.status){
                        swal('success',response.msg,'success').then(function(){
                            document.location.href=document.location.href;
                        });
                    }
                    else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						});
                    }
                }
            });
        });
    </script> --}}
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

@endpush
