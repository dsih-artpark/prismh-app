@extends('workers.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => __('messages.Dashboard'), 'back' => false])

    <div class="card card-style dashboard_section">
      <div class="content">
        <div class="row mb-0 py-0">
          <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
            <a href="{{ route('field-executive.servey_list') }}">
              <div class="card card-style mx-0 mb-0 text-center mobile-size" style="min-height:142px;">
                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                  <img src="{{asset('images/avatars/vbf_not_att.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60">
                </h1>
                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-18 ">
                  Larva Survey
                </p>
                <p class="font-10 opacity-30 mb-1"></p>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
            <a href="{{ route('field-executive.asha_workers') }}">
              <div class="card card-style mx-0 mb-0 text-center mobile-size" style="min-height:142px;">
                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                  <img src="{{asset('images/avatars/total_meeting.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60">
                </h1>
                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-18 ">
                  Survey Users
                </p>
                <p class="font-10 opacity-30 mb-1"></p>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-lg-3 col-6 mb-0 ">
            <a href="{{ route('field-executive.breeding_spots')}}">
              <div class="card card-style mx-0 mb-0 text-center mobile-size" style="min-height:142px;">
                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                  <img src="{{asset('images/avatars/vbf_opp.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60">
                </h1>
                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-18 ">
                  Breeding spots
                </p>
                <p class="font-10 opacity-30 mb-1"></p>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-lg-3 col-6 mb-0 ">
            <a href="{{ route('field-executive.report')}}">
              <div class="card card-style mx-0 mb-0 text-center mobile-size" style="min-height:142px;">
                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                  <img src="{{asset('images/avatars/statistics.jpg')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60">
                </h1>
                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-18 ">
                  Reports
                </p>
                <p class="font-10 opacity-30 mb-1"></p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection