@extends('asha_worker.auth.app', ['title' => __('messages.Confirm Password'), 'back'=>true, 'position'=>'left'])

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
    <div class="content mt-2 mb-0">
      <form class="mt-2" method="post" action="{{route('asha_worker.reset_password')}}">
        @csrf
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="number" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.regform23') }}" name="phone" value="{{$phone}}" readonly required>
          <label for="phone" class="color-highlight">{{ __('messages.regform23') }}*</label>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="password" class="form-control validate-text password" id="password" placeholder="@lang('messages.new password')" name="password" required>
          <label for="password" class="color-highlight">@lang('messages.new password')*</label>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="password" class="form-control validate-text ConfirmPassword"  placeholder="@lang('messages.confirm your password')" required>
          <label for="password" class="color-highlight">@lang('messages.confirm your password')*</label>
        </div>
        <div id="CheckPasswordMatch"></div>
        <center>
          <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900 btnsts" value="Submit">
        </center>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script type="text/javascript">
    "use strict";
    $(document).ready(function () {
      $(".ConfirmPassword").on('keyup', function(){
        var password = $("#password").val();
        var confirmPassword = $(".ConfirmPassword").val();
        if (password != confirmPassword){
          $("#CheckPasswordMatch").html("Password does not match").css("color","red");
          $(".btnsts").attr("disabled", true);
        }
        else{
          $("#CheckPasswordMatch").html("Password is matched ").css("color","green");
          $(".btnsts").attr("disabled", false);
        }
     });
    });
  </script>
@endsection
