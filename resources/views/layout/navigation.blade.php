@extends('layout.frontend')

@section('content')
<div class="" style="background-color: #fafafb; min-height: 100vh; overflow: hidden;">

    @if (session()->has('message'))
        <div class="tet" style="background-color: #fafafb; width: 20rem; position: absolute; top: 8rem; left: 2rem; box-shadow: 0px 4px 8px 0px #757575; z-index: 100; padding: 1rem">
            <div class="toast-header">
                <strong class="mr-auto">Notification</strong>
                <button type="button" id="button-close" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                {{session()->get('message')}}
            </div>
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed top-0 right-0 w-100" style="z-index: 10; min-height: ">
        <div class="container d-flex justify-content-between align-items-center py-3 px-3">

            {{-- GUEST PUNYA --}}
            @if ($user == null)
                <a href={{route('index')}} class="d-flex align-items-center h1 fw-bold mb-0 logo">
                    dribbbles
                </a>
                <div class="d-flex gap-3">
                    <button onclick="window.location='{{route('guest.login')}}'" class="btn btn-info btn-lg" style="color: black; background-color: transparent;" type="button">Sign in</button>
                    <button onclick="window.location='{{route('guest.register')}}'" class="btn btn-info btn-lg" style="background-color: #ea4c89;" type="button">Sign up</button>
                </div>
            @else
                {{-- USER PUNYA --}}
                @if ($user->role == 'user')
                    <a href={{route('index')}} class="d-flex align-items-center h1 fw-bold mb-0 logo">
                        dribbbles
                    </a>
                    <div class="d-flex align-items-center gap-3">
                        <a href={{route('user.profile')}}>
                            <img src={{asset('storage/profile/'.$user->picture)}} alt="user's profile" style="width: 40px; height:40px; border-radius: 100%">
                        </a>
                        <button onclick="window.location='{{route('user.upload')}}'" class="btn btn-info btn-lg" style="background-color: #ea4c89; border-color: transparent" type="button">upload</button>
                    </div>
                {{-- ADMIN PUNYA --}}
                @else
                    <a href={{route('index')}} class="d-flex align-items-center h1 fw-bold mb-0 logo">
                        dribbbles
                    </a>
                    <a href={{route('user.profile')}} class="d-flex align-items-center gap-3 " style="color: #ea4c89">
                        <img src={{asset('storage/profile/'.$user->picture)}} alt="user's profile" style="width: 40px; height:40px; border-radius: 100%">
                        <h3 class="logo">{{$user->name}}</h3>
                    </a>
                @endif
            @endif

        </div>
    </nav>

    <script>
        document.getElementById('button-close').addEventListener('click', () => {
            document.getElementsByClassName('tet')[0].style.display = 'none'
        })
    </script>

    <div style="margin-bottom: 90px"></div>

    @yield('inner-content')

</div>
@endsection

