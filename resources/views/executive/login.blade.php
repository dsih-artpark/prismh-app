<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin/assets/images/logo/bbmplogo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/bbmplogo.png') }}" type="image/x-icon">
    <title> PRISM-H</title>
	
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admin/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/responsive.css') }}">
  </head>
  <body>
    
    <!-- login page start-->
    <section>
    <div class="container-fluid p-0">
      <div class="row">
        <!--<img class="bg-img-cover bg-center" src="{{ asset('admin/assets/images/banner/wave1.avif') }}" alt="looginpage">-->
        <div class="col-lg-12 col-sm-12">
          <div class="login-card" style="background-color:white;">
            <form class="theme-form login-form shadow" style="background-color: border:1px solid black;" action="{{ route('executive.login') }}" method="post">
            {!! csrf_field() !!}
              <h4>Login</h4>
              <h6>Welcome back! Log in to your account.</h6>
              <div class="row">
                  <div class="col-lg-6 text-center" style="margin:auto;" style="margin:auto;position:relative;">
                    <img src="{{ asset('admin/assets/images/logo/bbmplogoheadone (1).jpg') }}" height="350px;" width="250px;"   alt="">
                    <div style="position:absolute;left:140px;top:270px;" class="text-center">
                        Powered By <br>
                           <img width="200" src="{{ asset('images/avatars/art_park.png') }}" />
                    </div>
                    <h6 class="text-dark fw-bold text-center">Bruhat Bengaluru Mahanagara Palike | District Bengaluru Urban, Government of Karnataka | India</h6>
                  </div>
              <div class="col-lg-6">
                <h4 class="text-center" style="color:#2a1570;">BBMP </h4>
              <h5 class="text-start mb-3 text-dark mt-5 mb-2 fs-5">Executive Login</h5>
              <div class="form-group">
                <label>Email Address</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  <input class="form-control" type="email" name="email" required="" autofocus placeholder="Test@gmail.com" value="{{ old('email') ?? '' }}">
                </div>
                @if($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input class="form-control" type="password" name="password" required="" placeholder="********">
                </div>
                @if($errors->has('password'))
                  <span class="text-danger">{{$errors->first('password')}}</span>
                @endif
              </div>
			  
              <div class="form-group d-flex justify-content-between">
                <a href="{{route('executive.login')}}?type=otp_login" class="text-primary">Login via OTP</a>
                <button class="btn btn-primary btn-block d-inline-block" type="submit">Sign in</button>
              </div>
            </div> 
          </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </section>
    <!-- latest jquery-->
    <script src="{{ asset('admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>