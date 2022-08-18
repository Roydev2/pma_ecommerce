@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection

@section('title','PRODUCT DETAIL')
@php
    $settings=DB::table('settings')->get();
@endphp
@section('main-content')

		<!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image plr--9---" data-bg="@foreach($settings as $data) {{ asset('assets/images/setting/'.$data->product_breadcrumb) }} @endforeach">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">//  Bienvenue</h6>
                                <h1 class="section-title white-color">Nos produits</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="{{route('home')}}">Accueil</a></li>
                                    <li>{{$product_detail->title}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- SHOP DETAILS AREA START -->
        <div class="ltn__shop-details-area pb-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="ltn__shop-details-inner mb-60">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ltn__shop-details-img-gallery">
                                        <div class="ltn__shop-details-large-img">
                                            <div class="single-large-img">
                                                @php
                                                    $photo=explode(',',$product_detail->photo);
                                                @endphp
                                                @foreach($photo as $data)
                                                    <a href="{{asset('assets/images/product/'.$data)}}" data-rel="lightcase:myCollection">
                                                        <img src="{{asset('assets/images/product/'.$data)}}" alt="{{$data}}">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal-product-info shop-details-info pl-0">
                                        <div class="product-ratting">
                                            <ul>
                                                @php
                                                    $rate=ceil($product_detail->getReview->avg('rate'))
                                                @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        @else
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        @endif
                                                    @endfor
                                                <li class="review-total"> <a href="#"> ({{$product_detail['getReview']->count()}}) Avis</a></li>
                                            </ul>
                                        </div>
                                        <h3>{{$product_detail->title}}</h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                            @endphp
                                            <span>{{number_format($after_discount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                                            <del>{{number_format($product_detail->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</del>
                                        </div>
                                        <div class="modal-product-meta ltn__product-details-menu-1">
                                            <ul>
                                                <li>
                                                    <strong>Categorie:</strong>
                                                    <span>
                                                        <a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a>
                                                    </span>
                                                </li>
												@if($product_detail->sub_cat_info)
                                                    <li>
                                                        <strong>Sous catégories:</strong>
                                                        <span>
                                                            <a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a>
                                                        </span>
                                                    </li>
												@endif
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-2">
                                            <form action="{{route('single-add-to-cart')}}" method="POST">
                                            @csrf
                                                <ul>
                                                    <li>
                                                        <div class="cart-plus-minus">
                                                            <input type="hidden" name="slug" value="{{$product_detail->slug}}">
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
                                            </form>
                                        </div>
                                        <div class="ltn__product-details-menu-3">
                                            <ul>
                                                <li>
                                                    <a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="" title="Wishlist">
                                                        <i class="far fa-heart"></i>
                                                        <span>Ajouter aux envies</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li>Stock:</li>
                                                <li>
                                                    @if($product_detail->stock>0)
                                                        <span class="badge badge-success">{{$product_detail->stock}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{$product_detail->stock}}</span>
                                                    @endif
                                                </li>

                                            </ul>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab Start -->
                        <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                            <div class="ltn__shop-details-tab-menu">
                                <div class="nav">
                                    <a class="active show" data-toggle="tab" href="#liton_tab_details_1_1">Description</a>
                                    <a data-toggle="tab" href="#liton_tab_details_1_2" class="">Reviews</a>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">{{$product_detail->title}}</h4>
                                        <p>{!! ($product_detail->description) !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="liton_tab_details_1_2">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">Avis des clients</h4>
                                        <hr>
                                        <!-- comment-area -->
                                        <div class="ltn__comment-area mb-30">
                                            <div class="ltn__comment-inner">
                                                <ul>
                                                    @foreach($product_detail['getReview'] as $data)
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                @if($data->user_info['photo'])
                                                                <img src="{{asset('assets/users/'.$data->user_info['photo'])}}" alt="{{$data->user_info['photo']}}">
                                                                @else
                                                                <img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
                                                                @endif
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">{{$data->user_info['name']}}</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        @for($i=1; $i<=5; $i++)
                                                                            @if($data->rate>=$i)
                                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            @else
                                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                            @endif
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                                <p>{{$data->review}}</p>
                                                                {{-- <span class="ltn__comment-reply-btn">September 3, 2020</span> --}}
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- comment-reply -->
                                        <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                            @auth
                                                <form method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                    @csrf
                                                    <h4 class="title-2">Ajouter un avis</h4>
                                                    <p>Votre adresse électronique ne sera pas publiée. Les champs obligatoires sont marqués</p>
                                                    <div class="mb-30">
                                                        <div class="add-a-review">
                                                            <h6>Votre avis:</h6>
                                                            <div class="product-ratting">
                                                                <div class="rating_box">
                                                                    <div class="star-rating">
                                                                      <div class="star-rating__wrap">
                                                                        <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars">1</label>
                                                                        <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars">2</label>
                                                                        <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars">3</label>
                                                                        <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars">4</label>
                                                                        <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars">5</label>
                                                                        @error('rate')
                                                                          <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                      </div>
                                                                    </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                                        <textarea name="review" placeholder="Ecrire votre commentaire...."></textarea>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Envoyer</button>
                                                    </div>
                                                </form>
                                            @else
                                            <p class="text-center p-5">
                                                You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>

                                            </p>
                                            <!--/ End Form -->
                                            @endauth
                                            <h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Global)</span></h4>
                                            <span>Basé sur {{$product_detail->getReview->count()}} Commentaires</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP DETAILS AREA END -->

		<!-- PRODUCT SLIDER AREA START -->
        <div class="ltn__product-slider-area ltn__product-gutter pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area ltn__section-title-2">
                            {{-- <h6 class="section-subtitle ltn__secondary-color">//  cars</h6> --}}
                            <h1 class="section-title">Produits associés<span>.</span></h1>
                        </div>
                    </div>
                </div>
                <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                    @foreach($product_detail->rel_prods as $data)
                        @if($data->id !==$product_detail->id)
                            <!-- ltn__product-item -->
                            <div class="col-lg-12">
                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                    <div class="product-img">
                                        @php
                                            $photo=explode(',',$data->photo);
                                        @endphp
                                        <a href="{{route('product-detail',$data->slug)}}">
                                            <img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}">
                                        </a>
                                        <div class="product-badge">
                                            <ul>
                                                <li class="sale-badge">{{$data->discount}} % Off</li>
                                            </ul>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul>
                                                <li>
                                                    <a href="#" title="Vue rapide" data-toggle="modal" data-target="#quick_view_modal{{$data->id}}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('add-to-cart',$data->slug)}}" title="Ajouter au panier">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('add-to-wishlist',$data->slug)}}" title="Envie">
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
                                        <div class="product-price">
                                            @php
                                                $after_discount=($data->price-(($data->discount*$data->price)/100));
                                            @endphp
                                            <span>{{number_format($data->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                                            <del>{{number_format($after_discount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- PRODUCT SLIDER AREA END -->

        <!-- MODAL AREA START (Quick View Modal) -->
        @if($product_detail->rel_prods)
            @foreach($product_detail->rel_prods as $key=>$product)
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
	<style>
		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: #F7941D;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}

	</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
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
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush
