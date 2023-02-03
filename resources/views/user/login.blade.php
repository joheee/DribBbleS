@extends('layout.frontend')

@section('title','Sign In | dribbbles')

@section('content')

<section class="vh-100" style="background-color: #f1cdd7;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card overflow-hidden" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-flex align-items-center" style="background-color: #f1cdd7;">
                    <img src={{asset('storage/assets/LoginBanner.jpg')}}
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST" action={{route('guest.loginUser')}}>
                        @csrf
                        <a href={{route('index')}} class="d-flex align-items-center mb-3 pb-1">
                            <img src={{asset('storage/assets/logo.png')}} alt="dribbbles logo" class="mr-3" style="width: 40px">
                            <span class="h1 fw-bold mb-0 logo">dribbbles</span>
                        </a>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign in to your account</h5>

                        <div class="form-outline mb-4">
                            <input type="email" id="form2Example17" class="form-control form-control-lg" placeholder="email" name="email" value='{{Cookie::get('last_email') ? Cookie::get('last_email') : ''}}'/>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example27" class="form-control form-control-lg" placeholder="password" name="password"/>
                        </div>

                        <div class="form-outline pl-4">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                            <label class="form-check-label" for="exampleCheck1">remember me</label>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" >
                                {{$errors->first()}}
                            </div>
                        @endif

                        <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block" type="submit">Sign in</button>
                        </div>

                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href={{route('guest.register')}}
                            style="color: #ea4c89;">Sign up here</a></p>
                    </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
