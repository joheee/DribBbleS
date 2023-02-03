@extends('layout.navigation')

@section('title','Browse thousands of Letter images for design inspiration | dribbbles')

@section('inner-content')

    <main role="main" style="min-height: 100vh; bg-light">
        <div style="background-color: #f2d184; display:flex; justify-content: center; position: relative">
            <img src={{asset('storage/assets/RegisterBanner.png')}} class="img-fluid" style="max-height: 366px">
            <div class="container" style="color: white; background-color: rgba(0, 0, 0, 0.3); width: fit-content; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); ">
                <h1 class="jumbotron-heading text-center mb-0 px-2 py-2">
                    {{count($posts)}} result for "{{$TagName}}"</h1>

            </div>

            <form method="GET" action={{route('user.searchByInput')}} class="input-group position-absolute px-3" style="bottom: -20px; max-width: 600px; height: 65px">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control bg-white h-100 pl-4 mt-0" placeholder="search.." name="search"/>
                </div>
                <button onclick="window.location='{{route('user.searchByInput')}}'" type="submit" class="btn btn-primary" style="background-color: #f2d184">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="album py-5">
            <div class="d-flex flex-wrap justify-content-center mb-4 gap-3">
                <div class="">Suggested:</div>
                @if (1 == 1)
                    @foreach ($tags as $tag)
                        @if(count($tag->postTags) > 0)
                            <a href={{route('user.searchByTag',$tag->TagName)}} style="color: #ea4c89">{{$tag->TagName}} ({{count($tag->postTags)}})</a>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="container">
            <div class="row">

                @foreach ($posts as $post)
                <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <a href={{route('user.postDetail', $post->id)}}>
                        <img class="card-img-top" style="height: 300px" src={{asset('storage/posts/'.$post->PostImage)}} alt="Card image cap">
                    </a>
                    <div class="card-body">
                    <p class="card-text text-truncate">{{$post->PostTitle}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="" class="d-flex align-items-center gap-2">
                            <img src={{asset('storage/profile/'.$post->postHeaders->users[0]->picture)}} alt="user's profile" class="img-fluid" style="width: 20px; height: 20px; border-radius: 100%">
                            <div class="">{{$post->postHeaders->users[0]->name}}</div>
                        </a>

                        <div class="d-flex align-items-center gap-4">
                            @if (count($post->postLikes) == 0)
                            <a href={{route('post.like', $post->id)}} class="d-flex align-items-center gap-2">
                                <div class="fa-solid fa-heart"></div>
                                <div class="">{{count($post->postLikes)}}</div>
                            </a>
                            @else
                                @foreach ($post->postLikes as $like)
                                    @if ($user != null && $user->id == $like->UserID)
                                        <a href={{route('post.like', $post->id)}} class="d-flex align-items-center gap-2" style='color:red'>
                                            <div class="fa-solid fa-heart"></div>
                                            <div class="">{{count($post->postLikes)}}</div>
                                        </a>
                                    @else
                                        <a href={{route('post.like', $post->id)}} class="d-flex align-items-center gap-2">
                                            <div class="fa-solid fa-heart"></div>
                                            <div class="">{{count($post->postLikes)}}</div>
                                        </a>
                                        @break
                                    @endif
                                @endforeach
                            @endif

                            <div class="d-flex align-items-center gap-2">
                                <div href="" class="fa-solid fa-eye"></div>
                                <div class="">{{count($post->postViews)}}</div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach

            <div class="" style="display: flex; justify-content: center">
                {{ $posts->links() }}
            </div>

        </div>
    </main>

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
