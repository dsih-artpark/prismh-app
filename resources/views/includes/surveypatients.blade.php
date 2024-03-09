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
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Fever Survey </h2>
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
                
                
                <form method="post" action="{{route('login.survey-patient.store')}}" enctype='multipart/form-data'>
            @csrf
<div class="row mb-4">
     <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="text" class="form-control validate-text latit" id="latit" placeholder="Please allow Location permission" name="latit" required readonly>
                <label for="latit" class="color-highlight ">Latitude / Longitude</label>
                
            </div>
                   
                  <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="text" class="form-control validate-text" name="name" value="" required>
                <label for="name" class="color-highlight ">Name</label>
                
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="text" class="form-control validate-text" name="phone" value="" required>
                <label for="phone" class="color-highlight ">Phone</label>
                
            </div>
              <div class="text-center">
            <input type="submit" class="btn btn-m rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="Submit">
            </div>
            
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
        // JavaScript to handle image capture and preview
        const cameraInput = document.getElementById('cameraInput');
        // const captureButton = document.getElementById('captureButton');
        const imagePreview = document.getElementById('imagePreview');

        // Event listener for the capture button
        // captureButton.addEventListener('click', () => {
        //     // Trigger the click event on the camera input
        //     cameraInput.click();
        // });

        // Event listener for file input change
        cameraInput.addEventListener('change', () => {
            // Clear the image preview
            imagePreview.innerHTML = '';

            // Loop through selected files and display them
            for (const file of cameraInput.files) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;
                img.style.maxWidth = '100px';
                img.style.marginRight = '10px';
                imagePreview.appendChild(img);
            }
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


 <script>
        let videoStream; // Variable to store the camera stream
        const captureCanvas = document.getElementById('capture-canvas');
        const captureBtn = document.getElementById('capture-btn');
        const imageDataInput = document.getElementById('image-data-input');
        
        
        // Function to open the camera stream
        function openCamera() {
            
            // Check if the browser supports the necessary APIs
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Access the camera
                const facingMode = { exact: 'environment' };
                navigator.mediaDevices.getUserMedia({ video: { facingMode } })
                    .then(stream => {
                        // Create a video element and attach the camera stream to it
                        const video = document.createElement('video');
                        video.srcObject = stream;
                        video.autoplay = true;

                        // Append the video element to the camera container
                        const cameraContainer = document.getElementById('camera-container');
                        cameraContainer.appendChild(video);

                        // Store the camera stream in the videoStream variable
                        videoStream = stream;
                    })
                    .catch(error => {
                        console.error('Error accessing camera:', error);
                    });
            } else {
                console.error('Camera access not supported by the browser.');
            }
        }

        // Function to capture an image from the camera stream
        function captureImage() {
            const videoElement = document.querySelector('video');
            const canvas = document.getElementById('capture-canvas');
            const context = canvas.getContext('2d');

            // Draw the current frame of the video onto the canvas
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Get the base64 representation of the captured image
            const imageData = canvas.toDataURL('image/png');
            
            // Set the captured image data as the value of the hidden input field
            imageDataInput.value = imageData;
            
            
        }

        document.addEventListener("DOMContentLoaded", function () {
            openCamera();
        });
        
        // Event listener for the capture button click
        captureBtn.addEventListener('click', captureImage);
        
        
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
            }
            else{
                $(".breeddiv").hide(); 
            }
               
        });

});





    
</script>
@endsection