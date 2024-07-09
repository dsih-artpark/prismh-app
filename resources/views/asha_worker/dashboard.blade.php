@extends('asha_worker.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('asha_worker.layout.header', ['title' => __('messages.Dashboard'), 'back' => false])
    
    <div class="card card-style opportunity_section">
      <div class="content">
        <div class="row mb-3">
          <h2 class="text-center pb-3"></h2>
          <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">{{$total_survey}}</h1>
            <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.Total larva survey') }}</h5>
          </div>
          <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">{{$today_survey}}</h1>
            <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.Todays larva survey') }}</h5>
          </div>
        </div>
      </div>
    </div>

    
    <div class="content mt-0">
      <div class="row">
        <div class="col-6">
          <a href="{{route('asha_worker.larva_survey.create')}}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">{{__('messages.Larva Survey')}}</a>
        </div>
        <div class="col-6">
          <a href="{{route('asha_worker.fever_survey.create')}}" class="btn btn-full btn-border btn-m rounded-s text-uppercase font-900 shadow-l border-highlight color-highlight">{{__('messages.Fever Survey')}}</a>
        </div>
      </div>
    </div>
    
  </div>
@endsection
