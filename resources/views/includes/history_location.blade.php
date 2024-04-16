@extends('includes.master')

@section('headerscript')
@parent
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css">
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{__('messages.location')}}</h2>
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
<div class="card card-style">
    @php $img = explode(',',$datadetails->image_data); @endphp
<div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/pick')}}//{{$img[0]}}">
<div class="card-bottom ms-3">
</div>
<div class="card-overlay "></div>
</div>
<div class="content mb-0">
    <h1 class="text-center">{{__('messages.Larva Survey Location')}}</h1>
    <div class="divider mb-0"></div>
<div class="p-2 row">
  <div id="map" style="width:100%;height:500px;"></div>
  <!-- <div id="directions" style="width:500px;height:500px;"></div> -->
</div>
</div>
</div>
         
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzhEbRtsoayqY94uOYInJIPCJp5Y6e7cY&callback=position&v=weekly" defer></script>

<script type="text/javascript">
  var lat='', long='';
  function showPosition(position) {
    lat = position.coords.latitude;
    long = position.coords.longitude;
    initMap();
  }
  function position(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
  }
  function initMap() {
    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    directionsDisplay.setMap(map);
    if(lat && long){
      var start = lat+','+long;
      var end = '{{$datadetails->latit}}';
      var request = {
        origin:start, 
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
      };
      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
          var myRoute = response.routes[0];
          var txtDir = '';
          for (var i=0; i<myRoute.legs[0].steps.length; i++) {
            txtDir += myRoute.legs[0].steps[i].instructions+"<br />";
          }
          // document.getElementById('directions').innerHTML = txtDir;
        }
      });
    }else{
      Swal.fire({
          text: 'Please Enable/Allow Location Permission.',
          icon: "",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Close"
        });
    }
  }
  window.initMap = initMap;
</script>
@endsection