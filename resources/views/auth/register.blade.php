@extends('front.layouts.main')
@section('content')
<style>

  // Large devices (desktops, 992px and up)
  @media (min-width: 992px) {
    .content{
      margin-top:250px;
      margin-bottom:250px;
    }
  }
  
  // Extra large devices (large desktops, 1200px and up)
  @media (min-width: 1200px) { 
     .content{
      margin-top:250px;
      margin-bottom:250px;
  
    }
   }  
  
   @media (min-width: 768px) {  
    .content{
      margin-top:250px;
      margin-bottom:250px;
  
    } 
  }
  
    </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{asset('front/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Create New Account</h3>
              <p class="mb-4">have an account? <a href="{{route('client.login')}}">Login here</a></p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group last mb-4">
                <label for="username">Name</label>
                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name*" >

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              
              <div class="form-group last mb-4">
                <label for="username">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email*" >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

    
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required  autofocus placeholder=" Password *" >

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
              </div>

              <div class="form-group last mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required  placeholder="confirm Your password *" >

                 @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

             
            
              <input type="submit" value="Register" class="btn btn-block btn-primary">

              {{-- <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
              
              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="fa fa-facebook mr-3"></span> 
                </a>
                <a href="#" class="twitter">
                  <span class="fa fa-twitter mr-3"></span> 
                </a>
                <a href="#" class="google">
                  <span class="fa fa-google mr-3"></span> 
                </a>
              </div> --}}
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

   @endsection

