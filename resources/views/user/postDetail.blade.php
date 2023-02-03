@extends('layout.navigation')

@section('title', $post->PostTitle)

@section('inner-content')

<div id="main-content" class="blog-page">
    <div class="container">
        <div class="row clearfix" style="padding: 24px 12px">
            <div class="col-lg-8 col-md-12 left-box">
                <div class="card single_post">
                    <div class="body">
                        <div class="img-post">
                            <img class="d-block img-fluid" src={{asset('storage/posts/'.$post->PostImage)}} alt="First slide">
                        </div>
                        <h3>{{$post->PostTitle}}</h3>
                        <p>{{$post->PostDesc}}</p>
                        @if (1 == 11)
                            <div class=""></div>
                        @else
                            <div class="mt-4 d-flex flex-wrap gap-3">
                                @foreach ($post->postTags as $i)
                                <button onclick="window.location='{{route('user.searchByTag',$i->TagName)}}'" class="btn btn-info btn-lg" type="button">{{$i->TagName}}</button>
                                @endforeach
                            </div>
                        @endif
                                <div class="d-flex align-items-center gap-4 mt-4">
                                        <a href={{route('post.like', $post->id)}} class="d-flex align-items-center gap-2">
                                            <div class="fa-solid fa-heart"></div>
                                            <div class="">{{count($post->postLikes)}}</div>
                                        </a>
                                    <div class="d-flex align-items-center gap-2">
                                        <div href="" class="fa-solid fa-eye"></div>
                                        <div class="">{{count($post->postViews)}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h3>Liked by ({{count($post->postLikes)}})</h3>
                            </div>
                            <div class="body">
                                <ul class="comment-reply list-unstyled">

                                    @if (count($post->postLikes) == 0)
                                        <h4 class="">empty...</h4>
                                    @else
                                        @foreach ($post->postLikes as $i)
                                            <li class="row clearfix">
                                                <div class="icon-box col-md-2 col-4">
                                                    <img class="img-fluid img-thumbnail" src={{asset('storage/profile/'.$i->users->picture)}} alt="Awesome Image">
                                                </div>
                                                <div class="text-box col-md-10 col-8 p-l-0 p-r0 d-flex align-items-center">
                                                    <h3 class="m-b-0">{{$i->users->name}} </h3>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>

                            <div class="card">
                                <div class="header">
                                    <h3>Viewed by ({{count($post->postViews)}})</h3>
                                </div>
                                <div class="body">
                                    <ul class="comment-reply list-unstyled">

                                        @if (count($post->postViews) == 0)
                                            <h4 class="">empty...</h4>
                                        @else
                                            @foreach ($post->postViews as $i)
                                                <li class="row clearfix">
                                                    <div class="icon-box col-md-2 col-4">
                                                        <img class="img-fluid img-thumbnail" src={{asset('storage/profile/'.$i->users->picture)}} alt="Awesome Image">
                                                    </div>
                                                    <div class="text-box col-md-10 col-8 p-l-0 p-r0 d-flex align-items-center">
                                                        <h3 class="m-b-0">{{$i->users->name}} </h3>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                </div>
                <div class="col-lg-4 col-md-12 right-box">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Created by</div>
                        <div class="card-body text-center" >
                            <div class="d-flex flex-column align-items-center gap-4">
                                <img class="img-account-profile rounded-circle mb-4 img-fluid" src={{asset('storage/profile/'.$creator->picture)}} alt="">
                                <h3 class="single_post">{{$creator->name}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="w-100 d-flex flex-column justify-items-center align-items-center " style="background-color: white; padding: 2em">
        <div class="">
            © 2022 Copyright from
        </div>
        <a href="https://dribbble.com/search" target='_blank' class="mx-1" style="color: #ea4c89;"> Dribbble</a>
        <div class="">
            by Johevin Blesstowi
        </div>
    </div>
    @endsection
