@extends('frontend.layouts.master')
@section('title','Wishlist Page')
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
                            <h1 class="section-title white-color">Mes envies</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Accueil</a></li>
                                <li>Mes envies</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

	<!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area mb-105">
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
                                    <th class="cart-product-price">Total</th>
                                    <th class="cart-product-quantity">Action</th>
                                </thead>
                                <tbody>
                                    @if(Helper::getAllProductFromWishlist())
								        @foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
                                            <tr>
                                                <td class="cart-product-remove"><a href="{{route('wishlist-delete',$wishlist->id)}}">x</a></td>
                                                @php
                                                    $photo=explode(',',$wishlist->product['photo']);
                                                @endphp
                                                <td class="cart-product-image">
                                                    <a href="{{route('product-detail',$wishlist->product['slug'])}}"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></h4>
                                                </td>
                                                <td class="cart-product-price">{{$wishlist['amount']}} @foreach($settings as $data) {{ $data->currency }} @endforeach</td>
                                                <td class="cart-product-add-cart">
                                                    <a class="submit-button-1" href="{{route('add-to-cart',$wishlist->product['slug'])}}" title="Ajouter au panier">Ajouter au panier</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">
                                                There are no any wishlist available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->


@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
