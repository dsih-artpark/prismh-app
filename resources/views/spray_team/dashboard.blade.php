@extends('spray_team.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('spray_team.layout.header', ['title' => __('messages.Dashboard'), 'back' => false])
    
    <div class="card card-style opportunity_section">
      <div class="content">
        <div class="row mb-3">
          <h2 class="text-center pb-3"></h2>
          <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">{{$total_sprayed}}</h1>
            <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">Total Sprayed</h5>
          </div>
          <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">{{$today_sprayed}}</h1>
            <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Today Sprayed</h5>
          </div>
        </div>
      </div>
    </div>    
  </div>
@endsection
