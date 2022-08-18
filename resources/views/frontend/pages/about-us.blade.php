@extends('frontend.layouts.master')

@php
    $settings=DB::table('settings')->get();
@endphp

@section('title','About Us')

@section('main-content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="@foreach($settings as $data) {{ asset('assets/images/setting/'.$data->about_breadcrumb) }} @endforeach">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">//  Bienvenue</h6>
                            <h1 class="section-title white-color">A propos de nous</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{route('home')}}">Accueil</a></li>
                                <li>A propos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

	<!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area pt-120--- pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <img src="@foreach($settings as $data) {{asset('assets/images/setting/'.$data->photo)}} @endforeach" alt="About Us Image">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">A propos de @foreach($settings as $data) {{$data->company_name}} @endforeach</h6>
                            {{-- <h1 class="section-title">Trusted Organic <br class="d-none d-md-block">  Food  Store</h1> --}}
                            <p>@foreach($settings as $data) {!! html_entity_decode($data->short_des) !!} @endforeach</p>
                        </div>
                        <p>@foreach($settings as $data) {!! html_entity_decode($data->description) !!} @endforeach</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US AREA END -->

    <!-- FEATURE AREA START ( Feature - 6) -->
    @if (count($feature) > 0)
        <div class="ltn__feature-area section-bg-1 pt-115 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area ltn__section-title-2 text-center">
                            <h6 class="section-subtitle ltn__secondary-color">//  Fonctionnement  //</h6>
                            <h1 class="section-title">Pourquoi nous choisir<span> ?</span></h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($feature as $key=>$item)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-7">
                                <div class="ltn__feature-icon-title">
                                    <div class="ltn__feature-icon">
                                        <span><img src="{{asset('assets/images/feature/'.$item->photo)}}" alt="#"></span>
                                    </div>
                                    <h3><a href="service-details.html">{{$item->title}}</a></h3>
                                </div>
                                <div class="ltn__feature-info">
                                    <p>{!! html_entity_decode($item->text) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- FEATURE AREA END -->

    <!-- TESTIMONIAL AREA START (testimonial-4) -->
    @if (count($testimonials) > 0)
        <div class="ltn__testimonial-area section-bg-1 pt-115 pb-70">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area ltn__section-title-2 text-center">
                            <h6 class="section-subtitle ltn__secondary-color">//  Témoignage</h6>
                            <h1 class="section-title">Commentaires des clients<span>.</span></h1>
                        </div>
                    </div>
                </div>
                <div class="row ltn__testimonial-slider-3-active slick-arrow-1 slick-arrow-1-inner">
                    @foreach ($testimonials as $key=>$item)
                        <div class="col-lg-12">
                            <div class="ltn__testimonial-item ltn__testimonial-item-4">
                                <div class="ltn__testimoni-img">
                                    <img src="{{asset('assets/images/testimonials/'.$item->photo)}}" alt="#">
                                </div>
                                <div class="ltn__testimoni-info">
                                    <p>{!! html_entity_decode($item->comment) !!}</p>
                                    <h4>{{$item->name}}</h4>
                                    <h6>{{$item->rank}}</h6>
                                </div>
                                <div class="ltn__testimoni-bg-icon">
                                    <i class="far fa-comments"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--  -->
                </div>
            </div>
        </div>
    @endif
    <!-- TESTIMONIAL AREA END -->
@endsection
