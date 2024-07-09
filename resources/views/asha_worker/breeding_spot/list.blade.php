@extends('asha_worker.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('asha_worker.layout.header', ['title' => __('messages.Breeding Spots'), 'back' => true])
    <div class="row mb-0">
      @foreach($surveys as $key => $survey)
      <div class="col-6">
        <div class="card card-style mb-3 {{$key % 2 != 0 ? 'ms-0 ps-0' : 'me-0 pe-0'}}">
          @php $img = explode(',',$survey->image_data); @endphp
          <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('asha_worker.breeding_spots_details', $survey->id)}}"></a>
          <div class="content mt-0">
            <span class="color-black">Id : {{$survey->uid}}</span>
            <br>
            <div class="divider mb-0"></div>
            <span class="color-black">{{__('messages.Date')}} : {!! date('d-m-Y ', strtotime($survey->created_at)) !!}</span><br>
            <span class="color-black">{{__('messages.Time')}} : {!! date('h:i a', strtotime($survey->created_at)) !!}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection