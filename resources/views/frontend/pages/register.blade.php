@extends('frontend.layouts.master')

@section('title','Register Page')
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
                            <h1 class="section-title white-color">Compte</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Accueil</a></li>
                                <li>Connexion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

     <!-- LOGIN AREA START (Register) -->
     <div class="ltn__login-area pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Enregistrez-vous</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="account-login-inner">
                        <form class="ltn__form-box contact-form-box"method="post" action="{{route('register.submit')}}">
                            @csrf
                            <input type="text" name="name" placeholder="Votre nom *" required="required" value="{{old('name')}}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="email" name="email" placeholder="Email *" required="required" value="{{old('email')}}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="password" name="password" placeholder="Mot de passe *" required="required" value="{{old('password')}}">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe *" required="required" value="{{old('password_confirmation')}}">
                            @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="btn-wrapper">
                                <button class="theme-btn-1 btn reverse-color btn-block" type="submit">S'incrire</button>
                            </div>
                        </form>
                        <div class="by-agree text-center">
                            <div class="go-to-btn mt-50">
                                <a href="{{route('login.form')}}">Vous avez d??j?? un compte ?</a><br><b>Ou</b><br>
                                <a href="{{route('login.redirect','facebook')}}" class="btn btn-info"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{route('login.redirect','github')}}" class="btn btn-dark"><i class="fab fa-github"></i></a>
                                <a href="{{route('login.redirect','google')}}" class="btn btn-danger"><i class="fab fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn{
        margin-right:0;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#ea4335;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
</style>
@endpush
