@extends('frontend.layouts.master')

@section('title','Blog Page')
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
                            <h1 class="section-title white-color">Notre blog</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{route('home')}}">Accueil</a></li>
                                <li>Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- BLOG AREA START -->
    <div class="ltn__blog-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__blog-list-wrap">
                        @foreach($posts as $post)
                        <!-- Blog Item -->
                        <div class="ltn__blog-item ltn__blog-item-5">
                            <div class="ltn__blog-img">
                                <a href="{{route('blog.detail',$post->slug)}}"><img src="{{asset('assets/images/post/'.$post->photo)}}" alt="{{$post->photo}}"></a>
                            </div>
                            <div class="ltn__blog-brief">
                                {{-- <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-category">
                                            <a href="#">Business</a>
                                        </li>
                                    </ul>
                                </div> --}}
                                <h3 class="ltn__blog-title"><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h3>
                                <div class="ltn__blog-meta">
                                    <ul>
                                        {{-- <li>
                                            <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                        </li> --}}
                                        {{-- <li>
                                            <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                        </li> --}}
                                        <li class="ltn__blog-date">
                                            <i class="far fa-calendar-alt"></i>{{$post->created_at->format('d M, Y. D')}}
                                        </li>
                                    </ul>
                                </div>
                                <p>{!! html_entity_decode($post->summary) !!}</p>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        @php
                                            $author_info=DB::table('users')->select('name','photo')->where('id',$post->added_by)->get();
                                        @endphp
                                        <ul>
                                            <li class="ltn__blog-author">
                                                <a href="#">
                                                    @foreach($author_info as $data)
                                                        @if($data->name)
                                                            <img src="{{asset('assets/users/'.$data->photo)}}" alt="#">Par:
                                                            {{$data->name}}
                                                        @else
                                                            Anonymous
                                                        @endif
                                                    @endforeach
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a href="{{route('blog.detail',$post->slug)}}"><i class="fas fa-arrow-right"></i>Lire Plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        @endforeach
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="ltn__pagination-area text-center">
                                <div class="ltn__pagination">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li class="active"><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">10</a></li>
                                        <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Rechercher un élément</h4>
                            <form method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Search Here..." name="search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Popular Post Widget -->
                        <div class="widget ltn__popular-post-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Postes récents</h4>
                            <ul>
                                @foreach($recent_posts as $post)
                                    <li>
                                        <div class="popular-post-widget-item clearfix">
                                            <div class="popular-post-widget-img">
                                                <a href="{{route('blog.detail',$post->slug)}}"><img src="{{asset('assets/images/post/'.$post->photo)}}" alt="{{$post->photo}}"></a>
                                            </div>
                                            <div class="popular-post-widget-brief">
                                                <h6><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h6>
                                                <div class="ltn__blog-meta">
                                                    <ul>
                                                        <li class="ltn__blog-date">
                                                            <a href="#"><i class="far fa-calendar-alt"></i>{{$post->created_at->format('d M, y')}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Menu Widget (Category) -->
                        <div class="widget ltn__menu-widget ltn__menu-widget-2 ltn__menu-widget-2-color-2">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Categories</h4>
                            <ul>
                                @if(!empty($_GET['category']))
                                    @php
                                        $filter_cats=explode(',',$_GET['category']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    {{-- {{count(Helper::postCategoryList())}} --}}
                                    @foreach(Helper::postCategoryList('posts') as $cat)
                                    <li>
                                        <a href="{{route('blog.category',$cat->slug)}}">{{$cat->title}} </a>
                                    </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                        <!-- Tagcloud Widget -->
                        <div class="widget ltn__tagcloud-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Tags</h4>
                            <ul>
                                @if(!empty($_GET['tag']))
                                    @php
                                        $filter_tags=explode(',',$_GET['tag']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    @foreach(Helper::postTagList('posts') as $tag)
                                        <li>
                                            <li>
                                                <a href="{{route('blog.tag',$tag->title)}}">{{$tag->title}} </a>
                                            </li>
                                        </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->
@endsection
@push('styles')
    <style>
        .pagination{
            display:inline-flex;
        }
    </style>

@endpush
