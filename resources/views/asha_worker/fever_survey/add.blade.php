@extends('asha_worker.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('asha_worker.layout.header', ['title' => __('messages.Fever Survey'), 'back' => true])
    <div class="card card-style" style="margin-bottom: 80px!important;">
      <div class="content mb-0">
        <form method="post" id="form" action="{{route('asha_worker.fever_survey.store')}}">
          @csrf
          <div class="row mb-4">
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
              <input type="text" class="form-control validate-text latit" id="latit" placeholder="Please allow Location permission" name="latit" required readonly>
              <label for="latit" class="color-highlight ">@lang('messages.LatLong')</label>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
              <input type="text" id="name" oninput="onlyAlpha(this)" class="form-control validate-text" name="name" value="" required>
              <label for="name" class="color-highlight ">@lang('messages.Name')</label>
            </div>
            <span id="name_error" class="text-danger"></span>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-0 mt-2">
              <input type="text" id="phone" onblur="checklength(this)" minlength="10" maxlength="10" oninput="onlyNumber(this)" class="form-control validate-text" name="phone" value="" required>
              <label for="phone" class="color-highlight ">@lang('messages.Mobile')</label>
            </div>
            <span id="phone_error" class="text-danger"></span>
            <div class="text-center">
              <input type="button" onclick="validate_phone()" class="btn btn-m rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="@lang('messages.Submit')">
            </div>
          </div>
        </form>
      </div>
    </div>    
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      var x = document.getElementById("demo");
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    });

    function onlyAlpha(e) {
      var inputElement = e;
      var inputValue = inputElement.value;
        var sanitizedValue = inputValue.replace(/[^a-zA-Z ]/g, '');
        inputElement.value = sanitizedValue;
    }

    function onlyNumber(e) {
        var inputElement = e;
        var inputValue = inputElement.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
        inputElement.value = sanitizedValue;
      }

      function validate_phone(e){
        let phone = $('#phone').val();
        let name = $('#name').val();
        if(name.length == 0){
          $('#name_error').text('Please enter name.');
        }else{
          $('#name_error').text('');
        }
        if(phone.length != 10){
          $('#phone_error').text('Please enter valid phone number.');
        }else{
          $('#phone_error').text('');
        }
        if(name.length != 0 && phone.length == 10){
          $('#phone_error').text('');
          $('#form').submit();
        }
      }

      function checklength(e){
        var inputElement = e;
        if(inputElement.value.length < 10){
          $('#phone_err').text('Please enter valid number.');
          $(e).focus();
          $('#submit_btn').prop('disabled', true);
        }else{
          $('#phone_err').text('');
          $('#submit_btn').prop('disabled', false);
        }
      }

    function showPosition(position) {
      var lat = position.coords.latitude;
      var long = position.coords.longitude;
      document.getElementById('latit').value = lat+","+long;
    }
  </script>
@endsection