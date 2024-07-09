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
            <form class="theme-form login-form shadow" style="background-color: border:1px solid black;" action="{{ route('executive.login') }}?type=otp_login" method="post">
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
                <label>Phone</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  <input class="form-control" id="phone" type="number" name="phone" required="" autofocus placeholder="Enter Your Phone Number" value="{{ old('phone') ?? '' }}">
                </div>
                <span id="phone_error" class="text-danger"></span>
                <span id="phone_success" class="text-success"></span>
                @if($errors->has('phone'))
                  <span class="text-danger">{{$errors->first('phone')}}</span>
                @endif
              </div>
              <div class="form-group" id="otp-div" style="display:{{old('otp') ? 'block' : 'none'}};">
                <label>OTP</label>
                <div class="input-group"><span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input class="form-control" type="text" name="otp" required="" placeholder="Enter Your OTP" value="{{ old('otp') ?? '' }}">
                </div>
                @if(Session::has('error'))
                  <span class="text-danger">{{Session::get('error')}}</span>
                @endif
              </div>
              <div class="form-group" id="otp-btn" style="display:{{old('otp') ? 'none' : 'block'}};">
                <button onclick="send_otp()" class="btn btn-primary btn-block position-relative" type="button">Send OTP
                <div style="display:none;position:absolute;left:5px;bottom:8px;" id="_spinner" class="spinner-border text-white spinner-border-sm mt-1 float-right" role="status">
                  <span class="sr-only"></span>
                </div>
                </button>
              </div>
			  
              <div class="form-group d-flex justify-content-between">
                <a href="{{route('executive.login')}}" class="text-primary">Login via Password</a>
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
    
    <script src="{{ asset('admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>

    <script>
      function send_otp(){
        $('#phone_error').text('');
        $('#phone_success').text('');
        let phone = $('#phone').val();
        if(phone.length < 10){
          if(phone.length == 0)
            $('#phone_error').text('Please Enter Your Number.');
          else
            $('#phone_error').text('Please Enter Correct Number.');
        }else{
          $('#_spinner').show();
          $.ajax({
            method: "GET",
            url: "{{ route('executive.login') }}",
            data: {_token: "{{csrf_token()}}", phone: phone},              
          })
          .done(function (res) {
            if(res.success){
              $('#phone_error').text('');
              $('#phone_success').text(res.message);
              $('#otp-btn').hide();
              $('#otp-div').show();
              $('#login-btn').show();
            }else{
              $('#phone_success').text('');
              $('#phone_error').text(res.message);
            }
            $('#_spinner').hide();
          })
          .fail(function (err) {
            console.log(err);  
            $('#_spinner').hide();            
          });
        }
      }
    </script>
  </body>
</html>