@extends('asha_worker.auth.app', ['title' => __('messages.Forgot password'), 'back'=>true, 'position'=>'left'])

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
      <form class="mt-2" method="get" action="{{route('asha_worker.send_forgot_otp')}}">
        @csrf
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="number" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.Mobile') }}" name="phone" required>
          <label for="phone" class="color-highlight">{{ __('messages.Mobile') }}*</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
        </div>
        <center>
          <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="{{ __('messages.Submit') }}">
        </center>
      </form>
    </div>
  </div>
@endsection
