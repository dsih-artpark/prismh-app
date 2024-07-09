@extends('asha_worker.auth.app', ['title' => __('messages.OTP verification'), 'back'=>true, 'position'=>'left'])

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
      <form class="mt-2" method="get" action="{{route('asha_worker.confirm_otp')}}">
        @csrf
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="number" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.Mobile') }}" name="phone" value="{{$phone}}" readonly required>
          <label for="phone" class="color-highlight">{{ __('messages.Mobile') }}*</label>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
          <input type="text" oninput="onlyNumeric(this)" maxlength="4" minlength="4" class="form-control validate-text phone" id="phone" placeholder="{{ __('messages.regform42') }}" name="otp" required>
          <label for="phone" class="color-highlight">OTP*</label>
        </div>
        <center>
          <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="{{ __('messages.Submit') }}">
        </center>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script>
    function onlyNumeric(e) {
      var inputElement = e;
      var inputValue = inputElement.value;
      var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
      inputElement.value = sanitizedValue;
    }
  </script>
@endsection
