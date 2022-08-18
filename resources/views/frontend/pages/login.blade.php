@extends('frontend.layouts.master')

@section('title','Login Page')
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

    <!-- LOGIN AREA START -->
    <div class="ltn__login-area pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Connectez-vous <br>à votre compte</h1>
                        <p>Veuillez vous enregistrer afin de pouvoir passer des commandes plus rapidement</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-login-inner">
                        <form method="post" action="{{route('login.submit')}}" class="ltn__form-box contact-form-box">
                            @csrf
                            <input type="email" name="email" placeholder="Email*" required="required" value="{{old('email')}}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="password" name="password" placeholder="Password*" required="required" value="{{old('password')}}">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">Connexion</button>
                            </div>
                            <label class="checkbox-inline">
                                <input name="news" id="2" type="checkbox">Se souvenir de moi
                            </label>
                            <div class="go-to-btn mt-20">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.reset') }}"><small>Mot de passe oublié ?</small></a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-create text-center pt-50">
                        <h4>VOUS N'AVEZ PAS DE COMPTE ?</h4>
                        <div class="btn-wrapper">
                            <a href="{{route('register.form')}}" class="theme-btn-1 btn black-btn">Créer un compte</a>
                            {{-- <br><b>Ou</b><br>
                            <a href="{{route('login.redirect','facebook')}}" class="btn btn-info"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{route('login.redirect','github')}}" class="btn btn-dark"><i class="fab fa-github"></i></a>
                            <a href="{{route('login.redirect','google')}}" class="btn btn-danger"><i class="fab fa-google"></i></a> --}}
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
