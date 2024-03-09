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
    <section>         </section>
    <div class="container-fluid p-0">
      <div class="row">
        <img class="bg-img-cover bg-center" src="{{ asset('admin/assets/images/banner/wave1.avif') }}" alt="looginpage">

        @if(\Session::get('success'))
         <div class="position-fixed top-0 end-0 p-3 dmo">
                      <div class="toast defaul-show-toast align-items-center text-white bg-success position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
                      <div class="toast-body">{{ \Session::get('success') }}   
                        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                    </div>
        @endif

        {{ \Session::forget('success') }}

        @if(\Session::get('error'))
         <div class="position-fixed top-0 end-0 p-3 dmo">
                      <div class="toast defaul-show-toast align-items-center text-white bg-danger position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
                      <div class="toast-body">{{ \Session::get('error') }}   
                        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                    </div>
        @endif 

        <div class="col-lg-12 col-sm-12">
          
          <div class="login-card" >
            <form class="theme-form login-form shadow" style="background-color: border:1px solid black;" action="{{ route('adminLoginPost') }}" method="post">

            {!! csrf_field() !!}
              <h4>{{ __('messages.adminWelcomeMsg1') }}</h4>
              <h6>{{ __('messages.adminWelcomeMsg2') }}</h6>
              
                 @php
                  $suc = Session::get('email');
                 @endphp


              <div class="row">
                  <div class="col-lg-6 text-center" style="margin:auto;">
                    <img src="{{ asset('admin/assets/images/logo/bbmplogoheadone (1).jpg') }}" height="350px;" width="250px;"   alt="">
                    <h6 class="text-dark fw-bold text-center">{{ __('messages.bbmpFullDets') }}</h6>
                  </div>
              
              <div class="col-lg-6">
                <h4 class="text-center" style="color:#2a1570;">{{ __('messages.bbmpShortForm') }} </h4>
              <h5 class="text-start mb-3 text-dark mt-5 mb-2 fs-5">{{ __('messages.admnLgn') }}</h5>
              <!-- <h6 class="text-center">Welcome back! Log in to your account.</h6> -->
              <div class="form-group">
                <label>{{ __('messages.admnEmail') }}</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  <input class="form-control" type="email" name="email" required="" autofocus placeholder="Test@gmail.com" value="<?= Session::has('email')  ? ''.$suc : '' ?>">

                  {{ \Session::forget('email') }}
                </div>
              </div>
              <div class="form-group">
                <label>{{ __('messages.admnPswd') }}</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input class="form-control" type="password" name="password" required="" placeholder="********">
                  <!-- <div class="show-hide"><span class="show">                         </span></div> -->

                  @if ($errors->has('password'))
                   <div class="invalid-tooltip">{{ $errors->first('password') }}</div>
                   @endif
                </div>
              </div>
			  
			  
              <!--<div class="form-group">
                <div class="checkbox">
                  <input id="checkbox1" type="checkbox">
                  <label for="checkbox1">Remember password</label>
                </div><a class="link " href="forget-password.html">Forgot password?</a>
              </div>-->
			  
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">{{ __('messages.adminSigin') }}</button>
              </div>
			  
              <!--<div class="login-social-title">                
                <h5>Create account</h5>
              </div>-->
			  
              <!--<div class="form-group">-->
                <!-- <ul class="login-social">
                  <li><a href="https://www.linkedin.com" target="_blank"><i data-feather="linkedin"></i></a></li>
                  <li><a href="https://twitter.com" target="_blank"><i data-feather="twitter"></i></a></li>
                  <li><a href="https://www.facebook.com" target="_blank"><i data-feather="facebook"></i></a></li>
                  <li><a href="https://www.instagram.com" target="_blank"><i data-feather="instagram">                  </i></a></li>
                </ul> -->
              <!--</div>-->
              <!--<p>Don't have account?<a class="ms-2" href="sign-up.html">Register</a></p>-->
            </div> 
          </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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