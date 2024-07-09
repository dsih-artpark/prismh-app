@extends('spray_team.layout.app')

@section('style')
  <style>
    video{
      width: -webkit-fill-available;
    }
  </style>
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('spray_team.layout.header', ['title' => 'Spray', 'back' => true])
    <div class="card card-style" style="margin-bottom: 80px!important;">
      <div class="content mb-0" >
        <form method="post" action="{{route('spray_team.spray_store')}}" enctype='multipart/form-data'>
          @csrf
          <div class="row mb-4">
            <div class="col-12 mb-4">
              <div id="camera-container"></div>
              <div class="text-center">
                <a href="#" class="btn btn-primary" id="capture-btn"><i class="fa fa-camera" aria-hidden="true"></i> Capture</a> 
              </div>
            </div>
            <div class="col-12 mb-4">
              <canvas id="capture-canvas"></canvas>
            </div>
            <input type="hidden" name="image_data" id="image-data-input">     
            <input type="hidden" class="form-control validate-text pid" id="pid" placeholder="name" name="pid" value="{{$id}}" readonly >
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
              <input type="text" class="form-control validate-text latit" id="latit" placeholder="Please allow Location permission" name="latit" required readonly>
              <label for="latit" class="color-highlight ">Latitude / Longitude</label>
            </div>
            <center>
              <input type="submit" class="sbt btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="Submit">
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      $(".s-alrte").fadeTo(4000, 500).fadeOut(3000, function(){
        $(".s-alrte").fadeOut(1000);
      });

      var x = document.getElementById("demo");
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      }else{ 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
      
      function showPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        document.getElementById('latit').value = lat+","+long;
      }
    });

    let videoStream;
    const captureCanvas = document.getElementById('capture-canvas');
    const captureBtn = document.getElementById('capture-btn');
    const imageDataInput = document.getElementById('image-data-input');
        
    function openCamera() {
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        const facingMode = { exact: 'environment' };
        navigator.mediaDevices.getUserMedia({ video: { facingMode } })
        .then(stream => {
          const video = document.createElement('video');
          video.srcObject = stream;
          video.autoplay = true;
          const cameraContainer = document.getElementById('camera-container');
          cameraContainer.appendChild(video);
          videoStream = stream;
        })
        .catch(error => {
          console.error('Error accessing camera:', error);
        });
      }else{
        console.error('Camera access not supported by the browser.');
      }
    }

    function captureImage() {
      const videoElement = document.querySelector('video');
      const canvas = document.getElementById('capture-canvas');
      const context = canvas.getContext('2d');
      context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
      const imageData = canvas.toDataURL('image/png');
      imageDataInput.value = imageData;
    }

    document.addEventListener("DOMContentLoaded", function () {
      openCamera();
    });
    captureBtn.addEventListener('click', captureImage);
  </script>
@endsection
