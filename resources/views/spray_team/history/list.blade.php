@extends('spray_team.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('spray_team.layout.header', ['title' => 'History', 'back' => true])
    <div class="row mb-0">
      @foreach($histories as $key => $history)
      <div class="col-6 mb-md-2">
        <div class="card card-style mb-3 {{$key % 2 != 0 ? 'ms-0 ps-0' : 'me-0 pe-0'}}">
          @php $img = explode(',',$history->image_data); @endphp
          <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('spray_team.history_details', $history->id)}}"></a>
          <div class="content mt-0 mx-2 text-center">
            <span class="color-black"><strong>{{$history->uid}}</strong></span>
            <br>
            <div class="divider mb-0"></div>
            <span class="color-black">{{__('messages.Date')}} : {!! date('d-m-Y ', strtotime($history->created_at)) !!}</span><br>
            <span class="color-black">{{__('messages.Time')}} : {!! date('h:i a', strtotime($history->created_at)) !!}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection