@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Events</h2>
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

@foreach($events as $event)
<div data-card-height="140" class="card card-style rounded-m shadow-xl ">
            <div class="card-top mt-4 ms-3">
                <h2 class="color-white text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                <p class="color-white font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                <p class="color-white font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
            </div>
            <div class="card-center me-3">
                <!--<a href="#" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>-->
                <a href="{{route('login.events.detail',['id' => $event->events_id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
            <div class="card-overlay bg-black opacity-80"></div>
        </div> 
@endforeach
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection