@extends('layout.navigation')

@section('title', $user->name.' | dribbbles')

@section('inner-content')
<div class="container-xl px-4" style="padding-top: 24px; height: 100%; ">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <form class="card mb-4 mb-xl-0" enctype="multipart/form-data" method="POST" action={{route('user.updateUserPicture')}}>
                @csrf
                @method('PATCH')
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center" >
                    <div class="d-flex flex-column align-items-center">
                        <label >
                            <input id="image" type="file" name="picture" id="" class="d-none">
                            <img id="preview-image" class="img-account-profile rounded-circle mb-4 img-fluid" src={{asset('storage/profile/'.$user->picture)}} alt="">
                        </label>
                        <button class="btn btn-primary" type="submit">Upload new image</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Profile Details</div>
                <div class="card-body">
                    <form method="POST" action={{route('user.updateUserDetail')}}>
                        @csrf
                        @method('PATCH')
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" type="text" name='name' placeholder="Enter your username" value={{$user->name}}>
                        </div>

                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name='email' placeholder="Enter your email address" value={{$user->email}}>
                        </div>

                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputWebsite">Your personal website</label>
                            <input class="form-control" id="inputWebsite" type="text" name='website' placeholder="Enter your personal website" value={{$user->website}}>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" >
                                {{$errors->first()}}
                            </div>
                        @endif

                        <!-- Save changes button-->
                        <div class="d-flex flex-wrap">
                            <button class="btn btn-primary mb-3" type="submit">Save changes</button>
                        </div>
                    </form>
                    <form action={{route('user.logout')}} method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const image = document.getElementById('image')
    const preview = document.getElementById('preview-image')
    image.addEventListener('change', e =>{
        preview.src = URL.createObjectURL(e.target.files[0])
    })
</script>
@endsection
