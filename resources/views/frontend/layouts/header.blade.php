@php
    $settings=DB::table('settings')->get();
@endphp
<!-- HEADER AREA START (header-5) -->
<header class="ltn__header-area ltn__header-5 ltn__header-transparent-- gradient-color-4---">
    <!-- ltn__header-top-area start -->
    <div class="ltn__header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="ltn__top-bar-menu">
                        <ul>
                            <li><a href="#"><i class="icon-placeholder"></i> @foreach($settings as $data) {{$data->address }} @endforeach</a></li>
                            <li><a href="mailto:@foreach($settings as $data) {{$data->email }} @endforeach"><i class="icon-mail"></i> @foreach($settings as $data) {{$data->email }} @endforeach</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="top-bar-right text-right">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                {{-- <li>
                                    <!-- ltn__language-menu -->
                                    <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                        <ul>
                                            <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                <ul>
                                                    <li><a href="#">Arabic</a></li>
                                                    <li><a href="#">Bengali</a></li>
                                                    <li><a href="#">Chinese</a></li>
                                                    <li><a href="#">English</a></li>
                                                    <li><a href="#">French</a></li>
                                                    <li><a href="#">Hindi</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li> --}}
                                <li>
                                    <!-- ltn__social-media -->
                                    <div class="ltn__social-media">
                                        <ul>
                                            {{-- <li><i class="icon-placeholder"></i><a href="{{route('order.track')}}">Suivre une commande</a></li> --}}
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>

                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                            {{-- <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-top-area end -->

    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white plr--9---">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="site-logo-wrap">
                        <div class="site-logo">
                            <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{ URL::to('assets/images/setting/'.$data->logo) }} @endforeach" alt="Logo"></a>
                        </div>
                    </div>
                </div>
                <div class="col header-menu-column menu-color-white---">
                    <div class="header-menu d-none d-xl-block">
                        <nav>
                            <div class="ltn__main-menu">
                                <ul>
                                    <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Acceuil</a></li>
                                    <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">A propos</a></li>
                                    <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Boutique</a></li>
                                    {{Helper::getHeaderCategory()}}
                                    <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>
                                    <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Nous Contacter</a></li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="ltn__header-options ltn__header-options-2 mb-sm-20">
                    <!-- header-search-1 -->
                    <div class="header-search-wrap">
                        <div class="header-search-1">
                            <div class="search-icon">
                                <i class="icon-search for-search-show"></i>
                                <i class="icon-cancel  for-search-close"></i>
                            </div>
                        </div>
                        <div class="header-search-1-form">
                            <form id="#" method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input type="text" name="search" value="" placeholder="Search here..."/>
                                <button type="submit">
                                    <span><i class="icon-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- user-menu -->
                    <div class="ltn__drop-menu user-menu">
                        <ul>
                            <li>
                                <a href="#"><i class="icon-user"></i></a>
                                <ul>
                                    @auth
                                        @if(Auth::user()->role=='admin')
                                            <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Dashboard</a></li>
                                        @else
                                            <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Dashboard</a></li>
                                        @endif
                                        <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Logout</a></li>
                                    @else
                                        <li><a href="{{route('login.form')}}">S'identifier</a></li>
                                        <li><a href="{{route('register.form')}}">S'incrire</a></li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- mini-cart -->
                    @php
                        $total_prod=0;
                        $total_amount=0;
                    @endphp
                    @if(session('wishlist'))
                        @foreach(session('wishlist') as $wishlist_items)
                            @php
                                $total_prod+=$wishlist_items['quantity'];
                                $total_amount+=$wishlist_items['amount'];
                            @endphp
                        @endforeach
                    @endif
                    <div class="mini-cart-icon">
                        <a href="#ltn__utilize-wishlist-menu" class="ltn__utilize-toggle">
                            <i class="far fa-heart"></i>
                            <sup>{{Helper::wishlistCount()}}</sup>
                        </a>
                    </div>
                    <div class="mini-cart-icon">
                        <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                            <i class="icon-shopping-cart"></i>
                            <sup>{{Helper::cartCount()}}</sup>
                        </a>
                    </div>

                    <!-- mini-cart -->
                    <!-- Mobile Menu Button -->
                    <div class="mobile-menu-toggle d-xl-none">
                        <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area end -->
</header>
<!-- HEADER AREA END -->

<!-- Utilize Wishlist Start -->
@auth
    <div id="ltn__utilize-wishlist-menu" class="ltn__utilize ltn__utilize-wishlist-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">{{count(Helper::getAllProductFromWishlist())}} Element</span>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="mini-cart-product-area ltn__scrollbar">
                @foreach(Helper::getAllProductFromWishlist() as $data)
                    @php
                        $photo=explode(',',$data->product['photo']);
                    @endphp
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="{{route('product-detail',$data->product['slug'])}}" target="_blank"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}"></a>
                            <a href="{{route('wishlist-delete',$data->id)}}"><span class="mini-cart-item-delete"><i class="icon-cancel"></i></span></a>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h6>
                            <span class="mini-cart-quantity">{{$data->quantity}} x {{number_format($data->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mini-cart-footer">
                <div class="mini-cart-sub-total">
                    <h5>Total: <span>{{number_format(Helper::totalWishlistPrice(),2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span></h5>
                </div>
                <div class="btn-wrapper">
                    <a href="{{route('cart')}}" class="theme-btn-1 btn btn-effect-1">Voir le panier</a>
                    <a href="{{route('wishlist')}}" class="theme-btn-2 btn btn-effect-2">Liste des envies</a>
                </div>
                {{-- <p>Free Shipping on All Orders Over $100!</p> --}}
            </div>

        </div>
    </div>
@endauth
<!-- Utilize Wishlist End -->

<!-- Utilize Cart Menu Start -->
@auth
    <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">{{count(Helper::getAllProductFromCart())}} Element</span>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="mini-cart-product-area ltn__scrollbar">
                @foreach(Helper::getAllProductFromCart() as $data)
                    @php
                        $photo=explode(',',$data->product['photo']);
                    @endphp
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="{{route('product-detail',$data->product['slug'])}}" target="_blank"><img src="{{asset('assets/images/product/'.$photo[0])}}" alt="{{$photo[0]}}"></a>
                            <a href="{{route('cart-delete',$data->id)}}"><span class="mini-cart-item-delete"><i class="icon-cancel"></i></span></a>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h6>
                            <span class="mini-cart-quantity">{{$data->quantity}} x {{number_format($data->price,2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mini-cart-footer">
                <div class="mini-cart-sub-total">
                    <h5>Total: <span>{{number_format(Helper::totalCartPrice(),2)}} @foreach($settings as $data) {{ $data->currency }} @endforeach</span></h5>
                </div>
                <div class="btn-wrapper">
                    <a href="{{route('cart')}}" class="theme-btn-1 btn btn-effect-1">Voir le panier</a>
                    <a href="{{route('checkout')}}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                </div>
                {{-- <p>Free Shipping on All Orders Over $100!</p> --}}
            </div>

        </div>
    </div>
@endauth
<!-- Utilize Cart Menu End -->

<!-- Utilize Mobile Menu Start -->
<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                <a href="{{route('home')}}"><img width="100" height="80" src="@foreach($settings as $data) {{ URL::to('assets/images/setting/'.$data->logo) }} @endforeach" alt="Logo"></a>
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="ltn__utilize-menu-search-form">
            <form action="#">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="ltn__utilize-menu">
            <ul>
                <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Acceuil</a></li>
                <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">A propos</a></li>
                <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Boutique</a></li>
                {{Helper::getHeaderCategory()}}
                <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>
                <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Nous Contacter</a></li>
            </ul>
        </div>
        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
            <ul>
                <li>
                    @auth
                        @if (Auth::user()->role=='admin')
                            <a href="{{route('admin')}}" target="_blank" title="My Account">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                Dashboard
                            </a>
                        @else
                            <a href="{{route('user')}}" target="_blank" title="My Account">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{route('login.form')}}">S'identifier</a>
                    @endauth

                </li>
                <li>
                    <a href="{{route('wishlist')}}" title="Wishlist">
                        <span class="utilize-btn-icon">
                            <i class="far fa-heart"></i>
                            <sup>{{Helper::wishlistCount()}}</sup>
                        </span>
                        Mes envies
                    </a>
                </li>
                <li>
                    <a href="cart.html" title="Shoping Cart">
                        <span class="utilize-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <sup>{{Helper::cartCount()}}</sup>
                        </span>
                        Mon panier
                    </a>
                </li>
            </ul>
        </div>
        <div class="ltn__social-media-2">
            <ul>
                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Utilize Mobile Menu End -->

<div class="ltn__utilize-overlay"></div>
