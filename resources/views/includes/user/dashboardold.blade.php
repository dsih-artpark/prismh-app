@extends('includes.user.master')

@section('headerscript')
@parent

@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <!--<a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>-->
    <h2>Dashboard</h2>
    
    <!--<div class="d-xs-block d-sm-block d-md-none d-lg-none d-xl-none text-capitalize" style="position: fixed;top: 32px;color: white;left: 185px;"> {{Auth::guard('customer')->user()->reg_id}}  {{Auth::guard('customer')->user()->username}}</div>-->
    <!--<div class="d-xs-none d-sm-none d-md-block d-lg-block d-xl-block text-capitalize" style="position: fixed;top: 32px;color: white;left: 200px;"> {{Auth::guard('customer')->user()->reg_id}} {{Auth::guard('customer')->user()->username}}</div>-->
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

<div class="card card-style opportunity_section">
            <div class="content">
                <div class="row mb-3">
                    <h2 class="text-center pb-3"></h2>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                     
                     <!--<h1 class="color-highlight mb-0 pb-1"><?=$data['given'];?></h1>-->
                        <!--<h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.dashboardtitle') }}<br> {{ __('messages.dashboardtitle1') }}</h5>-->
                        @php
                        $upid = Auth::guard('customer')->user()->id;
                        $res =  DB::table('dump')->where('cust_id', $upid)->where('created_at','LIke', \Carbon\Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
                        
                        
                        $rest =  DB::table('dump')->where('cust_id', $upid)->where('status', 1)->count();
                       
                        
                        @endphp
                        <h1 class="color-highlight mb-0 pb-1">{{$rest}}</h1>
                        <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">Total Sprayed</h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                       
                         <h1 class="color-highlight mb-0 pb-1">{{$res}}</h1>
                        <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Today Sprayed </h5>
                    </div>
                    
                   
                
                </div>
            </div>
        </div>
<!--<div class="card card-style opportunity_section">-->
           
<!--                <div class="row mt-3 mb-3">-->
<!--                    <div class="col-sm-12 col-md-12">-->
                   
<!--                    <div class="text-center">-->
<!--                        <video id="qrCodeScanner" width="200" height="200" autoplay></video>-->
<!--                    </div>-->
                    
                    
<!--                    </div>-->
                    
                   
                
<!--                </div>-->
            
<!--        </div>-->
       
        

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
<script src="{{asset('scripts/jsQR.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){

	// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
    
    
    
    // Get the video element and the scan button
const qrCodeScanner = document.getElementById('qrCodeScanner');
// const scanQRCodeBtn = document.getElementById('scanQRCodeBtn');

let captureInterval;

// Add click event listener to the scan button
// scanQRCodeBtn.addEventListener('load', () => {
    
    $('.momres').toggle();
    
    
    const facingMode = { exact: 'environment' };
    // Access the device's camera and display the video stream
    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
    // navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            qrCodeScanner.srcObject = stream;
            qrCodeScanner.play();
            // qrCodeScanner.addEventListener('play', captureFrame);
             qrCodeScanner.addEventListener('play', function() {
                 
                  const canvasElement = document.createElement('canvas');
    const canvasContext = canvasElement.getContext('2d');

function captureFrame() {
canvasContext.drawImage(qrCodeScanner, 0, 0, canvasElement.width, canvasElement.height);
const imageData = canvasContext.getImageData(0, 0, canvasElement.width, canvasElement.height);

const code = jsQR(imageData.data, imageData.width, imageData.height);
// const code = jsQR(imageData.data, imageData.width, imageData.height, {
//             inversionAttempts: 'dontInvert',
//         });

if (code) {

  console.log('QR code detected:', code.data);

var _id = code.data;
			$.ajax({
					type: "get",
					url: SITEURL + "/scanner/"+_id,
					success: function (data) {
					    
				// 	console.log('url:', data);
				
					   window.location.href = SITEURL+ "/user/detail/"+_id;
					   
				// 		window.location.reload();
					},
					error: function (data) {
					console.log('Error:', data);
					}
				});
				

} else {
// Call captureFrame() again to continuously capture frames
captureInterval = requestAnimationFrame(captureFrame);
}

}
function stopScanner() {
if (stream) {
stream.getTracks().forEach(track => {
track.stop(); // Stop the camera stream
});
}

if (captureInterval) {
cancelAnimationFrame(captureInterval); // Cancel the captureFrame() interval
}

if (qrCodeScanner) {
qrCodeScanner.removeEventListener('play', captureFrame); // Remove event listener
qrCodeScanner.srcObject = null; // Clear the video source
// document.body.removeChild(qrCodeScanner); // Remove the video element from DOM
}
}

function resetScanner() {
  stopScanner(); // Call stopScanner() to stop the scanner if it's running
  startScanner(); // Call startScanner() to start the scanner again
}                

                 
 

    captureFrame();
  });

            
        })
        .catch(error => {
            console.error('Error accessing camera:', error);
        });
// });



  








});
</script>
@endsection