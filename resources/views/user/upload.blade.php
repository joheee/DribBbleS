@extends('layout.navigation')

@section('title','Dribbble - Discover the World’s Top Designers & Creative Professionals')

@section('inner-content')

<div class="container-xl px-4" style="padding-top: 24px; height: 100%;">
    <form class="row" method="POST" action={{route('user.uploadNewPost')}} enctype="multipart/form-data">
        @csrf
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Post Picture</div>
                <div class="card-body text-center" >
                    <label class="d-flex flex-column align-items-center">
                        <img class="img-account-profile rounded-circle img-fluid" src={{asset('storage/posts/EmptyImage.jpg')}} alt="" id="preview-image">
                        <input type="file" name="PostImage" id="image" class="d-none">
                    </label>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Create new post!</div>
                <div class="card-body">
                    <div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Post title</label>
                            <input name='PostTitle' class="form-control" id="inputUsername" type="text" placeholder="New post title" >
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Post description</label>
                            <input name='PostDesc' class="form-control" id="inputEmailAddress" type="text" placeholder="New post description" >
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Post tags (separate by " , ")</label>
                            <input name='TagName' class="form-control" id="inputEmailAddress" type="text" placeholder="create post tags" >
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" >
                                {{$errors->first()}}
                            </div>
                        @endif
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">create new post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    const image = document.getElementById('image')
    const preview = document.getElementById('preview-image')
    image.addEventListener('change', e =>{
        preview.src = URL.createObjectURL(e.target.files[0])
    })
</script>


@endsection
