@extends('asha_worker.layout.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('asha_worker.layout.header', ['title' => __('messages.Larva Survey'), 'back' => true])
    @if(Session::has('success'))
        <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
          <span><i class="fa fa-check"></i></span>
          <strong>{{ Session::get('success') }}</strong>
          <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
      @endif
      @if(Session::has('error'))
        <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
          <span><i class="fa fa-times"></i></span>
          <strong>{{ Session::get('error') }}</strong>
          <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
      @endif
    <div class="card card-style" style="margin-bottom: 80px!important;">
      <div class="content mb-0">
        <form method="post" action="{{route('asha_worker.larva_survey.store')}}" enctype='multipart/form-data' onSubmit="submit_form()">
          @csrf
          <div class="row mb-4">
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
              <input type="text" class="form-control validate-text" value="{{Auth::guard('customer')->user()->username}}"  readonly>
              <label for="lat it" class="color-highlight ">{{__('messages.Reporter Name')}}</label>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
              <input type="text" class="form-control validate-text latit" id="latit" placeholder="Please allow Location permission" name="latit" required readonly>
              <label for="latit" class="color-highlight ">{{__('messages.LatLong')}}</label>
            </div>
            <div class="col-12 mb-3">
              <span class="color-highlight">{{__('messages.Does Breeding Spots Exist')}} ?</span>
              <div class="fac fac-radio "><span></span>
                <input id="box1-fac-radio-q11" class="breed" type="radio" name="q1" value="Yes" >
                <label for="box1-fac-radio-q11">{{__('messages.Yes')}}</label>
              </div>
              <div class="fac fac-radio "><span></span>
                <input id="box2-fac-radio-q12" class="breed" type="radio" name="q1" value="No" checked>
                <label for="box2-fac-radio-q12">{{__('messages.No')}}</label>
              </div>
            </div>
            <div class="breeddiv">
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 " style="position: relative;margin-bottom: 15px !important;">
              <label for="waste" class="color-highlight profess-tag">{{__('messages.Type of Container')}}</label>
              <select class="form-select waste profess-tag-1" id="waste" name="waste" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                <option label='Please Select' value=''>Select any one</option>
                <option value="Indoor">{{__('messages.Indoor')}}</option>
                <option value="Outdoor">{{__('messages.Outdoor')}}</option>
              </select>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 indoordiv" style="position: relative;margin-bottom: 15px !important;">
              <label for="waste" class="color-highlight profess-tag">{{__('messages.Indoor of the house')}}</label>
              <select class="form-select indoor profess-tag-1" id="indoor" name="indoor" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                <option label='Please Select' value=''>Select any one</option>
                <option value="Cement Tank">{{__('messages.Cement tank')}}</option>
                <option value="Byarrel/Plastic Drums">{{__('messages.Byarrel drums')}}</option>
                <option value="Refrigerators">{{__('messages.Refrigerators')}}</option>
                <option value="Others">{{__('messages.Others')}}</option>
              </select>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 outdoordiv" style="position: relative;margin-bottom: 15px !important;">
              <label for="waste" class="color-highlight profess-tag">{{__('messages.Outdoor of the house')}}</label>
              <select class="form-select outdoor profess-tag-1" id="outdoor" name="outdoor" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                <option label='Please Select' value=''>Select any one</option>
                <option value="Plastic Tanks/Drums">{{__('messages.Plastic Drums')}}</option>
                <option value="Cement Tanks/Sumps">{{__('messages.Cement Sumps')}}</option>
                <option value="Flower Pots">{{__('messages.Flower pots')}}</option>
                <option value="Tyres">{{__('messages.Tyres')}}</option>
                <option value="Other Solid Wastes">{{__('messages.Other solid wastes')}}</option>
              </select>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 " style="position: relative;margin-bottom: 15px !important;">
              <label for="waste" class="color-highlight profess-tag">{{__('messages.Source Reduction')}}</label>
              <select class="form-select source_reduction profess-tag-1" id="source_reduction" name="source_reduction" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                <option label='Please Select' value=''>Select any one</option>
                <option value="Done">{{__('messages.Done')}}</option>
                <option value="Not Done">{{__('messages.Not done')}}</option>
              </select>
            </div>
          </div>               
          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <textarea id="descp" class="form-control descp" placeholder="{{__('messages.Enter your remarks')}}" name="descp" required></textarea>
            <label for="descp" class="color-highlight">{{__('messages.Remarks')}}</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
          </div>
          <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
            <input type="file" class="form-control validate-text image" id="cameraInput" name="image[]" accept="image/*"  capture required>
            <label for="" class="color-highlight ">{{__('messages.Upload images')}}</label>
          </div>
          <div class="row">
            <div class="text-center" id="imagePreview"></div>
          </div>
          <center>
            <input type="submit" id="submit" class="sbt btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="{{__('messages.Submit')}}">
          </center>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).on('change', '.image', function (e) {
      var files = e.target.files;
      $('#imagePreview').html('');
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (function (file) {
          return function (e) {
            $('#imagePreview').append('<div class="preview-container d-flex flex-column align-items-center justify-content-center" data-fileindex="' + i + '" ><img class="preview-image" style="max-width:150px" src="' + e.target.result + '"><span class="remove-icon text-danger p-2" data-fileindex="' + i + '"><i class="fa fa-trash"></i> Delete</span></div>');
          };
        })(file);
      }
    });

    $(document).on('click', '.remove-icon', function () {
      var fileIndex = $(this).data('fileindex');
      $('.preview-container[data-fileindex="' + fileIndex + '"]').remove();
      $('.image').val('');
    });

    $(document).ready(function(){
      var x = document.getElementById("demo");
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
      
    });

    function submit_form(){
      document.getElementById('submit').disabled=true;
      var preloader = document.getElementById('preloader')
      if(preloader){preloader.classList.remove('preloader-hide');}
    }

    function showPosition(position) {
      var lat = position.coords.latitude;
      var long = position.coords.longitude;
      document.getElementById('latit').value = lat+","+long;
      $.ajax({
        method: "POST",
        url: "{{ route('asha_worker.survey_ward') }}",
        data: {_token: "{{csrf_token()}}", lat: lat, long: long},
      })
      .done(function (res) {
        if(res.success){
          Swal.fire({
            text: res.message,
            icon: "",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Close"
          });
        }
      })
      .fail(function (err) {
        console.log(err);              
      });

    }

    function permission_for(type){
      return new Promise((resolve) => {
        navigator.permissions.query({ name: type }).then(res => {
          if(res.state == 'denied')
          resolve(1);
          resolve(0);
        });
      });
    }

    async function check_permissions(){
      var msg = 'Please allow permissions for ';
      var is_camera = await permission_for('camera');
      var is_location = await permission_for('geolocation');
      
      navigator.permissions.query({ name: "geolocation" }).then(res => {
        if(res.state != 'granted') is_location = 1;
      });
      if(is_camera && is_location) msg += 'Camera & Location';
      else if(is_camera) msg += 'Camera';
      else if(is_location) msg += 'Location';
      else msg = '';
      if(msg.length){
        Swal.fire({
            text: msg,
            icon: "",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Close"
          });
      }
    }
    check_permissions();

    window.addEventListener( "pageshow", function ( event ) {
      var historyTraversal = event.persisted || 
                            ( typeof window.performance != "undefined" && 
                                  window.performance.navigation.type === 2 );
      if ( historyTraversal ) {
        window.location.reload();
      }
    });

    $(document).ready(function(){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(".form-select").select2({
        placeholder : "Placeholder",
        tags: true,
        minimumResultsForSearch: Infinity
      });
      $(".breeddiv").hide();
      $('body').on('click', '.breed', function () {
        let res = $(this).val();
        if(res == "Yes"){
          $(".breeddiv").show(); 
          $(".waste").attr('required',true);
          $(".source_reduction").attr('required',true);
        }
        else{
          $(".breeddiv").hide(); 
          $(".waste").attr('required',false);
          $(".source_reduction").attr('required',false);
        }
      });
      $(".indoordiv").hide(); 
      $(".outdoordiv").hide(); 
      $('body').on('change', '.waste', function () {
        let res = $(this).val();
        if(res == "Indoor"){
          $(".indoordiv").show();
          $(".outdoordiv").hide(); 
          $(".indoor").attr('required',true);
          $(".outdoor").attr('required',false);
        }
        else{
          $(".indoordiv").hide(); 
          $(".outdoordiv").show(); 
          $(".indoor").attr('required',false);
          $(".outdoor").attr('required',true);
        }   
      });
    });
  </script>
@endsection