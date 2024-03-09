@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Meetings</h2>
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
<div class="card card-style opp-section-tab pb-0">
            <div class="content" id="tab-group-3">
                <div class="tab-controls tabs-small tabs-rounded vbf-opp-tab" data-highlight="bg-red-dark">
                    <a href="#" class="no-effect"  data-bs-toggle="collapse" data-bs-target="#tab-1">Past</a>
                    <a href="#" class="no-effect" data-active data-bs-toggle="collapse" data-bs-target="#tab-2">Today</a>
                    <a href="#" class="no-effect" data-bs-toggle="collapse" data-bs-target="#tab-3">Upcoming</a>
                </div>
                <div class="clearfix mb-3"></div>
                <div data-bs-parent="#tab-group-3" class="collapse" id="tab-1">
                    @foreach($meetings['past'] as $event)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endforeach
                    @foreach($meetings['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                    @if($event->time < $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endif
                    @endforeach
                    
                </div>
                <div data-bs-parent="#tab-group-3" class="collapse show" id="tab-2">
                    @foreach($meetings['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                    @if($event->time >= $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endif
                    @endforeach
                </div>
                <div data-bs-parent="#tab-group-3" class="collapse" id="tab-3">
                    @foreach($meetings['upcoming'] as $event)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endforeach
                    @foreach($meetings['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                    @if($event->time > $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{Str::of($event->title)->limit(20)}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endif
                    @endforeach
                </div>
            </div>
        </div>


@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection