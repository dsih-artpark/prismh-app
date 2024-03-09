@extends('includes.master')

@section('headerscript')
@parent
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

@section('header')
@parent
@endsection

@section('content')


 


        <div class="page-title page-title-small ">
            <h2><a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a> Confirm Password</h2>
        </div>
        
        <div class="card header-card shape-rounded" data-card-height="150">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
        </div>
        
        @if(Session::has('error'))
        <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
            <span><i class="fa fa-times"></i></span>
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
        @endif

        <div class="card card-style">
            <div class="content mt-2 mb-0">

                <form class="mt-2" method="post" action="{{route('confirm-password')}}">
                    @csrf
                    
                    <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="number" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.regform23') }}" name="phone" value="{{$phone}}" readonly required>
                <label for="phone" class="color-highlight">{{ __('messages.regform2') }}*</label>
            </div>
            
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="password" class="form-control validate-text password" id="password" placeholder="new password" name="password" required>
                <label for="password" class="color-highlight">New Password*</label>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="password" class="form-control validate-text ConfirmPassword"  placeholder="confirm password" required>
                <label for="password" class="color-highlight">Confirm your Password*</label>
            </div>
            <div id="CheckPasswordMatch"></div>
            
            
                
                 
                <center>
                     <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900 btnsts" value="Submit">
                    
                </center>
                
                </form>
                
            </div>

        </div>


@endsection

@section('footer')
@parent
@endsection


@section('footerscript')
@parent
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