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
            <h2><a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a> OTP Verification</h2>
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

                <form class="mt-2" method="get" action="{{route('forgot-password.api')}}">
                    @csrf
                    <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="number" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.regform23') }}" name="phone" value="{{$phone}}" readonly required>
                <label for="phone" class="color-highlight">{{ __('messages.regform2') }}*</label>
            </div>
                    <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="text" oninput="onlyNumeric(this)" maxlength="4" minlength="4" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.regform42') }}" name="otp" required>
                <label for="phone" class="color-highlight">OTP*</label>
            </div>
            
                <center>
                     <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="Submit">
                    
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
<script>
  

function onlyNumeric(e) {
        var inputElement = e;
        var inputValue = inputElement.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
        inputElement.value = sanitizedValue;
    }
</script>
@endsection