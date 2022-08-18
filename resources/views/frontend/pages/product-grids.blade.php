@extends('frontend.layouts.master')

@php
    $settings=DB::table('settings')->get();
@endphp

@section('title','PRODUCT PAGE')

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
                                <li>Boutique</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PRODUCT DETAILS AREA START -->
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
                                            <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                            <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
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
                                            <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Categorie</option>
                                            {{-- <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option> --}}
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_product_grid">
                                <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                    <div class="row">
                                        @if(count($products)>0)
                                            @foreach($products as $product)
                                                <!-- ltn__product-item -->
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="ltn__product-item ltn__product-item-3 text-center">
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
                                                            <h2 class="product-title"><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h2>
                                                            <div class="product-price">
                                                                @php
                                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                                @endphp
                                                                <span>{{number_format($after_discount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                                                                <del>{{number_format($product->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</del>
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

                            <div class="tab-pane fade" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row">
                                        @if(count($products)>0)
                                            @foreach($products as $product)
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
                                {{$products->appends($_GET)->links()}}
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
    <!-- PRODUCT DETAILS AREA END -->

    <!-- MODAL AREA START (Quick View Modal) -->
    @if($products)
        @foreach($products as $key=>$product)
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
