@extends('frontend.layouts.master')

@section('title','E-TECH || Blog Detail page')

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

    <!-- PAGE DETAILS AREA START (blog-details) -->
    <div class="ltn__page-details-area ltn__blog-details-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__blog-details-wrap">
                        <div class="ltn__page-details-inner ltn__blog-details-inner">
                            <h2 class="ltn__blog-title">{{$post->title}}</h2>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><img src="{{asset('assets/users/'.$post->author_info['photo'])}}" alt="#">Par: {{$post->author_info['name']}}</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>{{$post->created_at->format('M d, Y')}}
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>{{$post->allComments->count()}} Commentaires</a>
                                    </li>
                                </ul>
                            </div>
                            <img src="{{asset('assets/images/post/'.$post->photo)}}" alt="{{$post->photo}}">
                            @if($post->quote)
                                <blockquote> {!! ($post->quote) !!}</blockquote>
                            @endif
                            <p>{!! ($post->description) !!}</p>
                            <hr>

                        </div>
                        <!-- blog-tags-social-media -->
                        <div class="ltn__blog-tags-social-media mt-80 row">
                            <div class="ltn__tagcloud-widget col-lg-8">
                                <h4>Tags :</h4>
                                <ul>
                                    @php
                                        $tags=explode(',',$post->tags);
                                    @endphp
                                    @foreach($tags as $tag)
                                    <li><a href="javascript:void(0);">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <!-- comment-area -->
                        <div class="ltn__comment-area mb-50">
                            <h4 class="title-2">{{$post->allComments->count()}} Commentaires</h4>
                            <div class="ltn__comment-inner">
                                <ul>
                                    @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <!-- comment-reply -->
                        @auth
                        <div class="ltn__comment-reply-area ltn__form-box mb-10">
                            <h4 class="title-2">Post Comment</h4>
                            <form action="{{route('post-comment.store',$post->slug)}}" method="POST">
                                @csrf
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="comment" placeholder="Type your comments...."></textarea>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    <input type="hidden" name="parent_id" id="parent_id" value="" />
                                </div>
                                <div class="btn-wrapper">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit"><i class="far fa-comments"></i> Poster le commentaire</button>
                                </div>
                            </form>
                        </div>
                        @else
                        <p class="text-center p-5">
                            You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a> for comment.
                        </p>
                        @endauth
                    </div>
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
    <!-- PAGE DETAILS AREA END -->
@endsection
@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush
@push('scripts')
<script>
$(document).ready(function(){

    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').hide();
            $(this).siblings('.btn-reply.cancel').show();

            var parent_id = $(this).data('id');
            var html = $('#commentForm');
            $( html).find('#parent_id').val(parent_id);
            $('#commentFormContainer').hide();
            $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
          });

        $('.comment-list').on('click','.btn-reply.cancel',function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-reply.reply').show();

            $('.comment_btn.reply').hide();
            $('.comment_btn.comment').show();

            $('#commentFormContainer').show();
            var html = $('#commentForm');
            $( html).find('#parent_id').val('');

            $('#commentFormContainer').append(html);
        });

 })(jQuery)
})
</script>
@endpush
