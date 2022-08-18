@extends('frontend.layouts.master')

@section('title','Checkout page')
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
                            <h1 class="section-title white-color">Checkout</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Accueil</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

     <!-- CHECHOUT AREA START -->
     <div class="ltn__checkout-area mb-105">
        <div class="container">
            <form class="form" method="POST" action="{{route('cart.order')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__checkout-inner">
                            <div class="ltn__checkout-single-content mt-50">
                                <h4 class="title-2">Effectuez votre paiement ici</h4>
                                <div class="ltn__checkout-single-content-info">
                                    <form action="#" >
                                        {{-- <h6>Personal Information</h6> --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="first_name" placeholder="Prénom" value="{{old('first_name')}}" value="{{old('first_name')}}">
                                                    @error('first_name')
                                                        <span class='text-danger'>{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="last_name" placeholder="Nom" value="{{old('lat_name')}}">
                                                    @error('last_name')
                                                        <span class='text-danger'>{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input type="email" name="email" placeholder="Adresse Email" value="{{old('email')}}">
                                                    @error('email')
                                                        <span class='text-danger'>{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-phone ltn__custom-icon">
                                                    <input type="text" name="phone" placeholder="Téléphone" required value="{{old('phone')}}">
                                                    @error('phone')
                                                        <span class='text-danger'>{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Country</h6>
                                                <div class="input-item">
                                                    <input type="text" name="country" id="country" placeholder="Pays / Ville" required>
                                                    @error('country')
                                                        <span class='text-danger'>{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <h6>Address</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-item">
                                                            <input type="text" name="address1" placeholder="Adresse 1" value="{{old('address1')}}">
                                                            @error('address1')
                                                                <span class='text-danger'>{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-item">
                                                            <input type="text" name="address2" placeholder="Adresse 2" value="{{old('address2')}}">
                                                            @error('address2')
                                                                <span class='text-danger'>{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Code postal</h6>
                                                <input type="text" name="post_code" placeholder="Code postal" value="{{old('post_code')}}">
                                                @error('post_code')
                                                    <span class='text-danger'>{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Coût de la livraison</h6>
                                                <div class="input-item">
                                                    @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                        <select name="shipping" class="nice-select">
                                                            <option value="">Selectionner votre adresse</option>
                                                            @foreach(Helper::shipping() as $shipping)
                                                            <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <span>Gratuit</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ltn__checkout-payment-method mt-50">
                            <h4 class="title-2">Mode de payement</h4>
                            <div id="checkout_accordion_1">
                                <input name="payment_method"  type="radio" value="cod"> <label> Payer à la livraison</label><br>
                                <input name="payment_method"  type="radio" value="orange_money"> <label> Orange Money</label>
                            </div>
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Procédez</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping-cart-total mt-50">
                            <h4 class="title-2">Total panier</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td data-price="{{Helper::totalCartPrice()}}">Sous Total</td>
                                        <td>{{number_format(Helper::totalCartPrice(),2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @if(session('coupon'))
                                    <tr>
                                        <td data-price="{{session('coupon')['value']}}">Vous économisez</td>
                                        <td>{{number_format(session('coupon')['value'],2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @endif
                                    @php
                                        $total_amount=Helper::totalCartPrice();
                                        if(session('coupon')){
                                            $total_amount=$total_amount-session('coupon')['value'];
                                        }
                                    @endphp
                                    @if(session('coupon'))
                                    <tr>
                                        <td>Total</td>
                                        <td>{{number_format($total_amount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>Total</td>
                                        <td>{{number_format($total_amount,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- CHECHOUT AREA START -->

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
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
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
