@extends('asha_worker.auth.app', ['title' => __('messages.Registration')])

@section('style')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    label.color-highlight.profess-tag {
        opacity: 1;
        left: 23px !important;
        transform: translateX(-14px) !important;
        margin-left: 0px !important;
        position: absolute;
        font-size: 12px;
        transition: all 250ms ease;
        background-color: #FFF;
        z-index: 996;
        top: -11px;
        padding: 0px 5px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 12px;
        right: 4px;
      
    }
    span.select2-selection.select2-selection--multiple {
        height: 53px !important;
        border-left-width: 1px !important;
        border-right-width: 1px !important;
        border-top-width: 1px !important;
        padding-left: 6px !important;
        padding-right: 10px !important;
        border-radius: 10px !important;
        padding-top: 8px !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
    }
    span.select2-selection.select2-selection--multiple {
        height: 55px !important;
    }

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
    <div class="content mb-0 mt-1 mb-3">
      <form method="post" action="{{route('asha_worker.register')}}" enctype='multipart/form-data'>
        @csrf
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
          <input type="name" oninput="onlyAlpha(this)" class="form-control validate-name" id="name" placeholder="{{ __('messages.Enter the name') }}" name="name" required>
          <label for="name" class="color-highlight font-400 font-13">{{ __('messages.Name') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>({{ __('messages.Required') }})</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
          <input type="text" onblur="checklength(this)" minlength="10" maxlength="10" oninput="onlyNumber(this)" class="form-control validate-name" id="phone" placeholder="{{ __('messages.Enter the mobile number') }}" name="phone" required>
          <label for="phone" class="color-highlight font-400 font-13">{{ __('messages.Mobile') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>({{ __('messages.Required') }})</em>
        </div>
        <span class="text-danger ms-3 d-block" id="phone_err"></span>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
          <input type="email" class="form-control validate-name" id="email" placeholder="{{ __('messages.Enter the email') }}" name="email" required>
          <label for="email" class="color-highlight font-400 font-13">{{ __('messages.Email') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>({{ __('messages.Required') }})</em>
        </div>
        <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
          <label for="ward" class="color-highlight profess-tag ">{{ __('messages.Select Role') }}*</label>
          <select required class="form-control profess-tag-1" id="role" name="roles" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
             <option value="" selected disabled>{{ __('messages.Select Role') }}</option> 
            @foreach($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
          <label for="ward" class="color-highlight profess-tag ">{{ __('messages.Ward') }}*</label>
          <select  required class="form-control ward profess-tag-1" id="ward" name="ward" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
          </select>
        </div>
        <div class="col-md-12 input-style-always-active has-borders no-icon mb-0" style="position: relative;margin-bottom: 0px !important;">
          <label for="id_card" class="color-highlight profess-tag ">{{ __('messages.ID card') }}</label>
          <input type="file" onchange="ValidateSingleInput(this);" class="form-control profess-tag-1" name="id_card" id="id_card" style="border-color: rgba(0, 0, 0, 0.08) !important;">
        </div>
        <span class="text-danger" id="id_err"></span>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
          <input type="password" class="form-control validate-name" id="password" placeholder="{{ __('messages.Enter the password') }}" name="password" required>
          <label for="password" class="color-highlight font-400 font-13">{{ __('messages.Password') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>({{ __('messages.Required') }})</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
          <input type="cpassword" class="form-control validate-name" id="cpassword" placeholder="{{ __('messages.Enter the confirm password') }}" name="cpassword" required>
          <label for="form1" class="color-highlight font-400 font-13">{{ __('messages.Confirm Password') }}</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>({{ __('messages.Required') }})</em>
          <p id="vmessage"></p>
        </div>
        <center>
          <input id="submit_btn" type="submit" class="btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="{{ __('messages.Submit') }}">
        </center>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
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
        if($(e).attr("name")=='phone' && inputElement.value.length == 10){
          validate_phone(inputElement.value);
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

      function validate_phone(number){
        $.ajax({
          method: "POST",
          url: "{{ route('asha_worker.validate_number') }}",
          data: {_token: "{{csrf_token()}}", phone: number}, 
        })
        .done(function (res) {
          if(res.success){
            $('#phone_err').text(res.message);
            $('#submit_btn').prop('disabled', true);
          }
          else{
            $('#phone_err').text('');
            $('#submit_btn').prop('disabled', false);
          }
        })
        .fail(function (err) {
          console.log(err);              
        });
      }

    $(document).ready(function(){

      $(".form-select").select2({
        placeholder : "Placeholder",
        tags: true,
        minimumResultsForSearch: Infinity
      });

      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "{{route('asha_worker.wards_list')}}",
        type: 'GET',
        dataType: 'JSON',
        success: function (data){ 
          if(data == ''){}
          else{
            $(".ward").append("<option label='{{ __('messages.Please Select') }}' value=''>Select</option>");
            $.each(data, function(i, item){
              $(".ward").append("<option value="+item.id+">"+item.name+"</option>");      
            });
          }
        }
      });
          
      $('#cpassword').on('keyup', function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
      
        if (password === confirmPassword) {
          $('#vmessage').text('Passwords match!');
          $('#cpassword').attr('required',true);
        } else {
          $('#vmessage').text('Passwords do not match. Please try again.');
          $('#cpassword').attr('required',false);
        }
      });
      
    });

    var _validFileExtensions = [".jpg", ".jpeg"];    
    function ValidateSingleInput(oInput) {
        $('#id_err').text('');
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    let fn = sFileName.split("\\");
                    let err = "Sorry, " + fn.at(-1) + " is invalid image file, allowed extensions are: " + _validFileExtensions.join(", ");
                    $('#id_err').text(err);
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
  </script>
@endsection
