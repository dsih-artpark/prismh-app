@extends('spray_team.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('spray_team.layout.header', ['title' => 'My Tasks', 'back' => true])
    <div class="row mb-0">
      @foreach($tasks as $key => $task)
      <div class="col-6 mb-md-2">
        <div class="card card-style mb-3 {{$key % 2 != 0 ? 'ms-0 ps-0' : 'me-0 pe-0'}}">
          @php $img = explode(',',$task->image_data); @endphp
          <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('spray_team.task_details', $task->id)}}"></a>
          <div class="content mt-0 mx-2 text-center">
            <span class="color-black"><strong>{{$task->uid}}</strong></span>
            <br>
            <div class="divider mb-0"></div>
            <span class="color-black">{{__('messages.Date')}} : {!! date('d-m-Y ', strtotime($task->created_at)) !!}</span><br>
            <span class="color-black">{{__('messages.Time')}} : {!! date('h:i a', strtotime($task->created_at)) !!}</span><br>
            @if($task->latit)
            <span onclick="getDirection({{explode(',',$task->latit)[0]}}, {{explode(',',$task->latit)[1]}})">
              <img width=12 src="{{url('public/images/avatars/map_icon.png')}}" alt="map_marker">
              Direction
            </span>
            @endif
            @if($task->q1 == "Yes")
              @php $dumpdetails =  DB::table('dump')->where('pid', $task->id)->first(); @endphp
              @if(empty($dumpdetails))
                <div class="text-center mt-2"><a href="{{route('spray_team.spray_add', $task->id)}}" class="btn bg-highlight ">Spray</a></div>
              @endif
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
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