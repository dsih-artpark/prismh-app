@extends('includes.master')

@section('headerscript')
@parent

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    video
    {
    width: -webkit-fill-available;
}
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{__('messages.Larva Survey')}}</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       @if(Auth::guard('customer')->user()->profile)
      <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}"></a>
        
        @else
         <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
        @endif
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
</div>

@if(Session::has('success'))

<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif



   <div class="card card-style" style="margin-bottom: 80px!important;">
            <div class="content mb-0" >
                
                
                <form method="post" action="{{route('login.pickstore')}}" enctype='multipart/form-data'>
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
                <select   class="form-select waste profess-tag-1" id="waste" name="waste" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                    <option label='Please Select' value=''>Select any one</option>
                    <option value="Indoor">{{__('messages.Indoor')}}</option>
                    <option value="Outdoor">{{__('messages.Outdoor')}}</option>
                    <!--<option value="Tier">Tier</option>-->
                    <!--<option value="Others">Others</option>-->
                </select>

            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 indoordiv" style="position: relative;margin-bottom: 15px !important;">
                <label for="waste" class="color-highlight profess-tag">{{__('messages.Indoor of the house')}}</label>
                <select   class="form-select indoor profess-tag-1" id="indoor" name="indoor" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                    <option label='Please Select' value=''>Select any one</option>
                    <option value="Cement Tank">{{__('messages.Cement tank')}}</option>
                    <option value="Byarrel/Plastic Drums">{{__('messages.Byarrel drums')}}</option>
                    <option value="Refrigerators">{{__('messages.Refrigerators')}}</option>
                    <option value="Others">{{__('messages.Others')}}</option>
                </select>

            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 outdoordiv" style="position: relative;margin-bottom: 15px !important;">
                <label for="waste" class="color-highlight profess-tag">{{__('messages.Outdoor of the house')}}</label>
                <select   class="form-select outdoor profess-tag-1" id="outdoor" name="outdoor" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
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
                <select   class="form-select source_reduction profess-tag-1" id="source_reduction" name="source_reduction" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
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
                <input type="file" class="form-control validate-text image" id="cameraInput" name="image[]" accept="image/*"   required>
                <label for="" class="color-highlight ">{{__('messages.Upload images')}}</label>
                
            </div>
            
            <!--<button type="button" id="captureButton">Capture Images</button>-->
        
        <!-- Display captured images -->
        
            <div class="row">
                <div class="text-center" id="imagePreview"></div>
            </div>
        
        
        
        
                 
                   
            
               
            
              <center>
            <input type="submit" class="sbt btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="{{__('messages.Submit')}}">
            </center>
            
            </div>
            
                </form>


            </div>
        </div>
                
                
               
                
               
                
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Function to handle file input change event
    $(document).on('change', '.image', function (e) {
        var files = e.target.files;

        // Clear previous preview
        $('#imagePreview').html('');

        // Loop through the selected files
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            // Create a FileReader
            var reader = new FileReader();

            // Read the image file as a data URL
            reader.readAsDataURL(file);

            // Closure to capture the file information
            reader.onload = (function (file) {
                return function (e) {
                    // Display image preview
                    $('#imagePreview').append('<div class="preview-container" data-fileindex="' + i + '" ><img class="preview-image" style="max-width:150px" src="' + e.target.result + '"><span class="remove-icon text-danger p-2" data-fileindex="' + i + '">X</span></div>');
                };
            })(file);
        }
    });

    // Function to handle remove icon click event
    $(document).on('click', '.remove-icon', function () {
        // Get the index of the file to remove
        var fileIndex = $(this).data('fileindex');
        
        $('.preview-container[data-fileindex="' + fileIndex + '"]').remove();
        $('.image').val('');

    });
</script>







<script>
$(document).ready(function() 
{
var x = document.getElementById("demo");



if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showPosition);
} else { 
x.innerHTML = "Geolocation is not supported by this browser.";
}


function showPosition(position) {

var lat = position.coords.latitude;
var long = position.coords.longitude;
// $("#lattitude").val(lat); 
// $("#longitude").val(long); 
document.getElementById('latit').value = lat+","+long;

}

});

</script>


 

<script type="text/javascript">

    $(document).ready(function(){
        
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


$(".form-select").select2({
          placeholder : "Placeholder",
          tags: true,
           minimumResultsForSearch: Infinity

      });
      
      //zone
$.ajax({
            url: '{{route('zone.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".zone").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".zone").append("<option value="+item.id+">"+item.title+"</option>");      
                    });
                }
            }
        }); 
       
       $(".ddiv").hide();
       //divisions
        $('.zone').on('change', function()
        {

                $.ajax({
                    url: '{{route('division.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, zone:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        if(data == '')
                        {
                            $(".ddiv").hide();
                            
                        }
                        else
                        {
                            $(".ddiv").show();
                            $(".division").html('');
                            $(".division").append("<option label='Please Select' value=''>Select any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".division").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        }); 
        
        $(".wdiv").hide();
        //wards
        $('.division').on('change', function()
        {

                $.ajax({
                    url: '{{route('ward.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, division:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        if(data == '')
                        {
                             $(".wdiv").hide();
                            
                        }
                        else
                        {
                             $(".wdiv").show();
                            $(".ward").html('');
                            $(".ward").append("<option label='Please Select' value=''>Select </option>");
                            $.each(data, function(i, item)
                            {
                                $(".ward").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        });
        
         $(".breeddiv").hide(); 
        //breed
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
            
            // alert(res);
            
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