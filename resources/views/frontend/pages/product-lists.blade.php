@extends('frontend.layouts.master')

@section('title','PRODUCT PAGE')

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
                                    <li><a href="index.html">Accueil</a></li>
                                    <li>Boutique</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

		<form action="{{route('shop.filter')}}" method="POST">
		@csrf
        <div class="ltn__product-area ltn__product-gutter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 order-lg-2 mb-120">
                        <div class="ltn__shop-options">
                            <ul>
                                <li>
                                    <div class="ltn__grid-list-tab-menu ">
                                        <div class="nav">
                                            {{-- <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                            <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a> --}}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="short-by text-center">
                                        <select class="show" name="show" onchange="this.form.submit();">
                                            <option value="">Afficher</option>
                                            <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
                                            <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                            <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                            <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="short-by text-center">
                                        <select class='nice-select sortBy' name='sortBy' onchange="this.form.submit();">
                                            <option value="">Trier par</option>
                                            <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Nom</option>
                                            <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Prix</option>
                                            <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Catégorie</option>
                                            {{-- <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option> --}}
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @if($products)
			                                @foreach($products as $key=>$product)
                                                <!-- ltn__product-item -->
                                                <div class="col-lg-12">
                                                    <div class="ltn__product-item ltn__product-item-3">
                                                        <div class="product-img">
                                                            <a href="{{route('product-detail',$product->slug)}}">
                                                                @php
                                                                    $photo=explode(',',$product->photo);
                                                                @endphp
                                                                <img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}">
                                                            </a>
                                                            <div class="product-badge">
                                                                <ul>
                                                                    @if($product->discount)
                                                                        <li class="sale-badge">{{$product->discount}} % Off</li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <h2 class="product-title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h2>
                                                            {{-- <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                </ul>
                                                            </div> --}}
                                                            <div class="product-price">
                                                                @php
                                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                                @endphp
                                                                <span>{{number_format($after_discount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                                                                <del>{{number_format($product->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</del>
                                                            </div>
                                                            <div class="product-brief">
                                                                <p>{!! html_entity_decode($product->summary) !!}</p>
                                                            </div>
                                                            <div class="product-hover-action">
                                                                <ul>
                                                                    <li>
                                                                        <a href="#" title="Vue rapide" data-toggle="modal" data-target="#quick_view_modal{{$product->id}}">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{route('add-to-cart',$product->slug)}}" title="Ajouter au panier">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{route('add-to-wishlist',$product->slug)}}" title="Envie">
                                                                            <i class="far fa-heart"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  -->
                                            @endforeach
                                        @else
                                            <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ltn__pagination-area text-center">
                            <div class="ltn__pagination">
                                {{-- {{$products->appends($_GET)->links()}} --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  mb-120">
                        <aside class="sidebar ltn__shop-sidebar">
                            <!-- Category Widget -->
                            <div class="widget ltn__menu-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Categories</h4>
                                <ul>
                                    @php
                                        // $category = new Category();
                                        $menu=App\Models\Category::getAllParentWithChild();
                                    @endphp
                                    @if($menu)
                                        <li>
                                            @foreach($menu as $cat_info)
                                                @if($cat_info->child_cat->count()>0)
                                                    <li>
                                                        <a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}
                                                            <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                                        </a>
                                                        <ul>
                                                            @foreach($cat_info->child_cat as $sub_menu)
                                                                <li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}
                                                        <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                                    </a></li>
                                                @endif
											@endforeach
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Price Filter Widget -->
                            {{-- <div class="widget ltn__price-filter-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Filtrer par prix</h4>
                                <div class="price_filter">
                                    <div class="price_slider_amount">
                                        <input type="submit"  value="Your range:"/>
                                        <input type="text" class="amount" name="price"  placeholder="Add Your Price" />
                                    </div>
                                    <div class="slider-range"></div>
                                </div>
                            </div> --}}
                            <!-- Top Rated Product Widget -->
                            <div class="widget ltn__top-rated-product-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Nouveaux produits</h4>
                                <ul>
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        @php
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                            <li>
                                                <div class="top-rated-product-item clearfix">
                                                    <div class="top-rated-product-img">
                                                        <a href="{{route('product-detail',$product->slug)}}"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}" alt="#"></a>
                                                    </div>
                                                    <div class="top-rated-product-info">
                                                        {{-- <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            </ul>
                                                        </div> --}}
                                                        <h6><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h6>
                                                        @php
                                                            $org=($product->price-($product->price*$product->discount)/100);
                                                        @endphp
                                                        <div class="product-price">
                                                            <span>{{number_format($org,2)}}  @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                                                            <del>{{number_format($product->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                </ul>
                            </div>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
		</form>
		<!-- Modal -->
		@if($products)
			@foreach($products as $key=>$product)
				<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
								</div>
								<div class="modal-body">
									<div class="row no-gutters">
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<!-- Product Slider -->
												<div class="product-gallery">
													<div class="quickview-slider-active">
														@php
															$photo=explode(',',$product->photo);
														// dd($photo);
														@endphp
														@foreach($photo as $data)
															<div class="single-slider">
																<img src="{{asset('assets/images/product/'.$data)}}" alt="{{$data}}">
															</div>
														@endforeach
													</div>
												</div>
											<!-- End Product slider -->
										</div>
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<div class="quickview-content">
												<h2>{{$product->title}}</h2>
												<div class="quickview-ratting-review">
													<div class="quickview-ratting-wrap">
														<div class="quickview-ratting">
															{{-- <i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="yellow fa fa-star"></i>
															<i class="fa fa-star"></i> --}}
															@php
																$rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
																$rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
															@endphp
															@for($i=1; $i<=5; $i++)
																@if($rate>=$i)
																	<i class="yellow fa fa-star"></i>
																@else
																<i class="fa fa-star"></i>
																@endif
															@endfor
														</div>
														<a href="#"> ({{$rate_count}} customer review)</a>
													</div>
													<div class="quickview-stock">
														@if($product->stock >0)
														<span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
														@else
														<span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
														@endif
													</div>
												</div>
												@php
													$after_discount=($product->price-($product->price*$product->discount)/100);
												@endphp
												<h3><small><del class="text-muted">${{number_format($product->price,2)}}</del></small>    ${{number_format($after_discount,2)}}  </h3>
												<div class="quickview-peragraph">
													<p>{!! html_entity_decode($product->summary) !!}</p>
												</div>
												@if($product->size)
													<div class="size">
														<h4>Size</h4>
														<ul>
															@php
																$sizes=explode(',',$product->size);
																// dd($sizes);
															@endphp
															@foreach($sizes as $size)
															<li><a href="#" class="one">{{$size}}</a></li>
															@endforeach
														</ul>
													</div>
												@endif
												<form action="{{route('single-add-to-cart')}}" method="POST">
													@csrf
													<div class="quantity">
														<!-- Input Order -->
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="hidden" name="slug" value="{{$product->slug}}">
															<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
														<!--/ End Input Order -->
													</div>
													<div class="add-to-cart">
														<button type="submit" class="btn">Add to cart</button>
														<a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
													</div>
												</form>
												<div class="default-social">
												<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
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
			<!-- Modal end -->
@endsection
@push ('styles')
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
        color: white;
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
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						});
                    }
                }
            })
        });
	</script> --}}
	<script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>

@endpush
