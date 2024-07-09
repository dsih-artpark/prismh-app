@extends('asha_worker.auth.app')

@section('style')
  <style>
    .header{
        display:none;
    }
    .back-to-top{
        display : none;
    }
    #footer-bar {
        display:none;
    }
    .footer-card{
        bottom : 0px !important;
    }
  </style>
@endsection

@section('content')
  <div class="card card-style">
    <div class="content">
      <div class="col-12 ps-0">
        <div class="text-center">
          <img src="{{asset('admin/assets/images/logo/small-logo.png')}}" width="75" height="75" class="rounded-xl ">
        </div>
      </div>
  </div>
  <div class="content mt-2 mb-0">
    <h2 class="mb-3 color-highlight">{{ __('messages.title') }}</h2>
      <form method="post" action="{{route('asha_worker.login')}}">
        @csrf
        <div class="input-style no-borders has-icon validate-field mb-4">
          <i class="fa fa-user"></i>
          <input type="number" class="form-control validate-name" id="form1a"  name="phone" placeholder="{{ __('messages.regform6') }}" required>
          <label for="form1a" class="color-blue-dark font-10 mt-1">{{ __('messages.regform6') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>(required)</em>
        </div>
        <span id="phone_error" class="text-danger"></span>
        <span id="phone_success" class="text-success"></span>
        <div class="input-style no-borders has-icon validate-field mb-4" id="otp-div" style="display:none;">
          <i class="fa fa-lock"></i>
          <input type="number" class="form-control validate-password" id="form3a" placeholder="{{ __('messages.regform42') }}" name="otp" required>
          <label for="form3a" class="color-blue-dark font-10 mt-1">{{ __('messages.regform42') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>(required)</em>
        </div>
        <center>
          <div class="position-relative d-inline-block">
            <input type="button" id="otp-btn" onclick="send_otp()" class="btn mt-4 mb-4 px-4 py-3 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="{{ __('messages.Send OTP') }}">
            <div style="display:none;position:absolute;left:26px;bottom:62px;" id="_spinner" class="spinner-border text-white spinner-border-sm mt-1 float-right" role="status">
              <span class="sr-only"></span>
            </div>
            <input type="submit" id="login-btn" style="display:none;" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="{{ __('Login') }}">
            <a class="text-success" href="{{ route('asha_worker.login') }}">@lang('messages.Login via password')</a>
          </div>
        </center>
      </form>
      <div class="divider mt-4 mb-3"></div>
      <div class="d-flex justify-content-between">
        <div class="font-900 pb-2 color-highlight opacity-60 pb-3 text-start"><a href="{{ route('asha_worker.register') }}" class="p-2 bg-highlight rounded-sm">{{ __('messages.reghead') }}</a></div>
        <div class="font-900 pb-2 color-highlight opacity-60 pb-3 text-end text-nowrap"><a href="{{ route('asha_worker.forgot_password') }}" class="p-2 bg-highlight rounded-sm">{{ __('messages.loginforgort') }}</a></div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script>
    function send_otp(){
      $('#phone_error').text('');
      $('#phone_success').text('');
      let phone = $('#form1a').val();
      if(phone.length < 10){
        if(phone.length == 0)
          $('#phone_error').text('Please Enter Your Number.');
        else
          $('#phone_error').text('Please Enter Correct Number.');
      }else{
        $('#_spinner').show();
        $.ajax({
          method: "GET",
          url: "{{ route('asha_worker.login') }}",
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
@endsection
