@extends('frontend.layouts.master')
@section('title','Cart Page')
@php
    $settings=DB::table('settings')->get();
@endphp
@section('main-content')
	<!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="@foreach($settings as $data) {{ asset('assets/images/setting/'.$data->product_breadcrumb) }} @endforeach">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">//  Bienvenue</h6>
                            <h1 class="section-title white-color">Mon panier</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Accueil</a></li>
                                <li>Panier</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

	<!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <th class="cart-product-remove">Remove</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Nom</th>
                                    <th class="cart-product-price">Prix Unitaire</th>
                                    <th class="cart-product-quantity">Quantité</th>
                                    <th class="cart-product-subtotal">Total</th>
                                </thead>
                                <tbody>
                                    <form action="{{route('cart.update')}}" method="POST">
                                        @csrf
                                        @if(Helper::getAllProductFromCart())
                                            @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                                <tr>
                                                    <td class="cart-product-remove"><a href="{{route('cart-delete',$cart->id)}}">x</a></td>
                                                    @php
                                                        $photo=explode(',',$cart->product['photo']);
                                                    @endphp
                                                    <td class="cart-product-image">
                                                        <a href="{{route('product-detail',$cart->product['slug'])}}"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}"></a>
                                                    </td>
                                                    <td class="cart-product-info">
                                                        <h4><a href="{{route('product-detail',$cart->product['slug'])}}">{{$cart->product['title']}}</a></h4>
                                                    </td>
                                                    <td class="cart-product-price">{{number_format($cart['price'],2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                                    <td class="cart-product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <input type="text" value="{{$cart->quantity}}" name="quant[{{$key}}]" class="cart-plus-minus-box" data-min="1" data-max="100">
                                                        </div>
                                                        <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
                                                    </td>
                                                    <td class="cart-product-subtotal">{{$cart['amount']}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                                </tr>
                                            @endforeach
                                            <tr class="cart-coupon-row">
                                                <td colspan="6">

                                                </td>
                                                <td>
                                                    <button type="submit" class="btn theme-btn-2 btn-effect-2--">Mettre à jour le panier</button>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center">
                                                    There are no any carts available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>
                                                </td>
                                            </tr>
                                        @endif
							        </form>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{route('coupon-store')}}" method="POST">
                            @csrf
                            <div class="cart-coupon">
                                <input type="text" name="code" placeholder="Entrez votre coupon">
                                <button type="submit" class="btn theme-btn-2 btn-effect-2">Appliquer le coupon</button>
                            </div>
                        </form>
                        <div class="shoping-cart-total mt-50">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td data-price="{{Helper::totalCartPrice()}}">Sous Total</td>
                                        <td>{{number_format(Helper::totalCartPrice(),2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @if(session()->has('coupon'))
                                    <tr>
                                        <td data-price="{{Session::get('coupon')['value']}}">Vous économisez</td>
                                        <td>{{number_format(Session::get('coupon')['value'],2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @endif
                                    @php
                                        $total_amount=Helper::totalCartPrice();
                                        if(session()->has('coupon')){
                                            $total_amount=$total_amount-Session::get('coupon')['value'];
                                        }
                                    @endphp
                                    @if(session()->has('coupon'))
                                    <tr>
                                        <td> <strong>Vous payer</strong> </td>
                                        <td><strong>{{number_format($total_amount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</strong></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td><strong>Vous payer</strong> </td>
                                        <td><strong>{{number_format($total_amount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</strong></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="btn-wrapper text-right">
                                <a href="{{route('checkout')}}" class="theme-btn-1 btn btn-effect-1">Checkout</a>
                            </div><br>
                            <div class="btn-wrapper text-right">
                                <a href="{{route('product-grids')}}" class="theme-btn-1 btn btn-effect-1">Continue d'acheter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->

@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

@endpush
