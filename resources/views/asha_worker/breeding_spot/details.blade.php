@extends('asha_worker.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('asha_worker.layout.header', ['title' => __('messages.details'), 'back' => true])

    <div class="card card-style">
      @php $img = explode(',',$survey->image_data); @endphp
      <div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/pick')}}//{{$img[0]}}">
        <div class="card-bottom ms-3"></div>
        <div class="card-overlay "></div>
      </div>
      <div class="content mb-0">
      <h1 class="text-center">{{__('messages.Larva Survey details')}}</h1>
      <div class="divider mb-0"></div>
      <div class="p-2">
        <span class="">{{$survey->uid}}</span><br>
        <span class="">{{$survey->latit}}</span><br>
        @if($survey->q1)
          <span class="">{{__('messages.Does Breeding Spots Exist')}} ? {{$survey->q1}}</span>
        @endif
        @if($survey->q1 == "Yes")
        - <span class="">{{$survey->waste}}</span>
        @endif
        <br>
        <span class="">{{$survey->descp}}</span>
        <br>
        <span class="">{!! date('d-m-Y', strtotime($survey->created_at)) !!}</span>
        <br>
        <span class="">{!! date('h:i a', strtotime($survey->created_at)) !!}</span>
        <br><br>
        @if($survey->latit)
        <button onclick="getDirection({{explode(',',$survey->latit)[0]}}, {{explode(',',$survey->latit)[1]}})" class="btn btn-success btn-sm">
          <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 470.746 470.746" xml:space="preserve" stroke="#ffffff" transform="rotate(0)">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="31.069236"></g>
            <g id="SVGRepo_iconCarrier"> 
              <g> 
                <path d="M349.636,293.382c2.861,1.883,6.732,1.612,9.26-0.725c2.285-2.112,3.02-5.504,1.83-8.375 c-1.143-2.757-3.87-4.593-6.854-4.632c-3.194-0.041-6.122,2.052-7.156,5.063C345.63,287.875,346.831,291.536,349.636,293.382z"></path> 
                <path d="M437.373,346.725h-24.977c-2.353-18.676-13.493-36.313-32.584-51.395c-3.251-2.569-7.968-2.015-10.534,1.235 c-2.568,3.25-2.015,7.966,1.235,10.534c10.958,8.657,23.759,22.185,26.722,39.625h-31.382c-4.143,0-7.5,3.358-7.5,7.5 s3.357,7.5,7.5,7.5h31.375c-3.264,19.254-19.036,37.41-45.25,51.769c-29.26,16.028-67.762,25.259-109.105,26.257v-26.236 c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v26.236c-41.343-0.998-79.846-10.23-109.105-26.257 c-26.214-14.359-41.986-32.514-45.25-51.769h31.375c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5H73.509 c3.297-19.662,19.02-34.518,32.458-43.875c20.259-14.108,48.277-24.647,79.586-30.063v60.277c0,15.804,12.857,28.661,28.661,28.661 c8.372,0,15.916-3.609,21.16-9.352c5.245,5.743,12.789,9.352,21.161,9.352c15.804,0,28.66-12.857,28.66-28.661V272.79 c15.63,2.688,30.392,6.62,43.966,11.75c0.873,0.33,1.769,0.486,2.65,0.486c3.029,0,5.882-1.849,7.017-4.851 c1.465-3.875-0.489-8.203-4.364-9.667c-15.205-5.746-31.755-10.082-49.269-12.933v-6.905h4.706 c13.947,0,25.294-11.347,25.294-25.294v-75.363c0-27.429-19.033-50.483-44.582-56.683c11.087-9.781,18.101-24.079,18.101-39.992 C288.714,23.928,264.786,0,235.374,0c-29.411,0-53.339,23.928-53.339,53.339c0,15.913,7.013,30.211,18.1,39.992 c-25.55,6.2-44.583,29.255-44.583,56.683v75.363c0,13.947,11.347,25.294,25.294,25.294h4.706v6.893 c-34.468,5.644-65.578,17.251-88.158,32.976c-22.743,15.837-36.357,35.553-39.027,56.185H33.373c-4.143,0-7.5,3.358-7.5,7.5 s3.357,7.5,7.5,7.5h24.973c3.121,24.852,21.736,47.681,53.214,64.924c31.409,17.205,72.469,27.09,116.313,28.104v8.493 c0,4.142,3.357,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-8.493c43.844-1.014,84.902-10.899,116.312-28.104 c31.479-17.243,50.094-40.072,53.215-64.924h24.973c4.143,0,7.5-3.358,7.5-7.5S441.516,346.725,437.373,346.725z M197.035,53.339 c0-21.14,17.199-38.339,38.339-38.339c21.141,0,38.34,17.199,38.34,38.339s-17.199,38.339-38.34,38.339 C214.234,91.679,197.035,74.48,197.035,53.339z M170.553,225.377v-75.363c0-23.896,19.44-43.336,43.336-43.336h42.971 c23.896,0,43.336,19.44,43.336,43.336v75.363c0,5.676-4.618,10.294-10.294,10.294h-4.706v-83.156c0-4.142-3.357-7.5-7.5-7.5 s-7.5,3.358-7.5,7.5v90.656v89.893c0,7.533-6.128,13.661-13.66,13.661c-7.533,0-13.661-6.128-13.661-13.661v-89.893 c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v89.893c0,7.533-6.128,13.661-13.66,13.661c-7.533,0-13.661-6.128-13.661-13.661 V152.515c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v83.156h-4.706C175.171,235.671,170.553,231.054,170.553,225.377z"></path> 
              </g> 
            </g>
          </svg>
          Direction
        </button>
        @endif
        <br><br>
 
        @if($survey->q1 == "Yes")
          @php $dumpdetails =  DB::table('dump')->where('pid', $survey->id)->first(); @endphp
          @if(empty($dumpdetails))
            @if(empty($survey->source_reduction))
              <div class="text-end"><a href="{{--route('login.source-reduction.id', ['id' => $survey->id])--}}" class="btn btn-sm bg-highlight ">Source Reduction</a></div>
            @endif
          @endif
        @endif
      </div>
    </div>


    @php $dumpdetails =  DB::table('dump')->where('pid', $survey->id)->first(); @endphp
    @if($dumpdetails)
      <div class="card card-style">
        <div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/dump')}}/<?=$dumpdetails->image_data;?>">
          <div class="card-bottom ms-3"></div>
          <div class="card-overlay "></div>
        </div>
        <div class="content mb-0">
          <h1 class="text-center">Spray Details</h1>
          <div class="divider mb-0"></div>
          <div class="p-2">
          <span class="">{{$dumpdetails->uid}}</span>
          <br>
          <span class="">{{$dumpdetails->latit}}</span>
          <br>
          <span class="">{!! date('d-m-Y', strtotime($dumpdetails->created_at)) !!}</span>
          <br>
          <span class="">{!! date('h:i a', strtotime($dumpdetails->created_at)) !!}</span>
        </div>
      </div>
    @else
      @if($survey->source_reduction == "Done")
        <div class="card card-style">
          <div class="content mb-0">
            <h1 class="text-center">{{__('messages.Source reduction details')}}</h1>
            <div class="divider mb-0"></div>
            <div class="p-2">
            <span class="">{{__('messages.Source Reduction')}} : {{$survey->source_reduction}}</span><br>
          </div>
        </div>
      @endif
    @endif

  </div>
@endsection

@section('script')
  <script>
    var s_lat='', s_long='';
    function showPosition(position) {
      s_lat = position.coords.latitude;
      s_long = position.coords.longitude;
    }
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    function getDirection(d_lat, d_long){
      let url = 'https://www.google.com/maps/dir/?api=1&origin='+s_lat+','+s_long+'&destination='+d_lat+','+d_long;
      window.open(url,'_blank');
    }
  </script>
@endsection
