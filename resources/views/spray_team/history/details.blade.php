@extends('spray_team.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('spray_team.layout.header', ['title' => 'History Details', 'back' => true])

    <div class="card card-style">
      @php $img = explode(',',$history->image_data); @endphp
      <div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/pick')}}//{{$img[0]}}">
        <div class="card-bottom ms-3"></div>
        <div class="card-overlay "></div>
      </div>
      <div class="content mb-0">
        <h1 class="text-center">Survey Details</h1>
        <div class="divider mb-0"></div>
        <div class="p-2">
          <span class="">{{$history->uid}}</span><br>
          <span class="">{{$history->latit}}</span><br>
          @if($history->q1)
            <span class="">Does Breeding Spots Exist ? {{$history->q1}}</span>
          @endif
          @if($history->q1 == "Yes")
          - <span class="">{{$history->waste}}</span>
          @endif
          <br>
          <span class="">{{$history->descp}}</span>
          <br>
          <span class="">{!! date('d-m-Y', strtotime($history->created_at)) !!}</span>
          <br>
          <span class="">{!! date('h:i a', strtotime($history->created_at)) !!}</span>
          <br><br>
        </div>
      </div>
    </div>

    @if($dump_details)
      <div class="card card-style">
        <div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/dump')}}/<?=$dump_details->image_data;?>">
          <div class="card-bottom ms-3"></div>
          <div class="card-overlay "></div>
        </div>
        <div class="content mb-0">
          <h1 class="text-center">Spray Details</h1>
          <div class="divider mb-0"></div>
          <div class="p-2">
          <span class="">{{$dump_details->uid}}</span>
          <br>
          <span class="">{{$dump_details->latit}}</span>
          <br>
          <span class="">{!! date('d-m-Y', strtotime($dump_details->created_at)) !!}</span>
          <br>
          <span class="">{!! date('h:i a', strtotime($dump_details->created_at)) !!}</span>
        </div>
      </div>
    @endif

  </div>
@endsection
