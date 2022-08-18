<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')
</head>
<body>
    <div class="body-wrapper">
        @include('frontend.layouts.notification')
        <!-- Header -->
        @include('frontend.layouts.header')
        <!--/ End Header -->
        @yield('main-content')

        @include('frontend.layouts.footer')
    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="{{asset('frontend/assets/js/plugins.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
</body>
</html>
