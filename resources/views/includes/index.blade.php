@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2  data-username="" class=" text-capitalize">{{ __('messages.indexhead') }}</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       @if(Auth::guard('customer')->user()->profile)
      <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}"></a>
        
        @else
         <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
        @endif
</div>
<div class="card header-card shape-rounded" data-card-height="210">
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

<div class="splide single-slider slider-no-arrows slider-no-dots homepage-slider" id="single-slider-1">
    <div class="splide__track">
        <div class="splide__list">

            @if(!empty($dash['banner']))

            @foreach($dash['banner'] as $banner)

            <div class="splide__slide">
                <div class="card rounded-l mx-2 text-center shadow-l " data-card-height="320" style="background-image:url('{{asset('uploads/banner')}}/{{$banner->image}}');">
                    <div class="card-bottom ">
                        <h1 class="font-24 font-700 text-white">{{$banner->title}}</h1>
                        <p class="boxed-text-xl banner-sub-title text-white" style="">{{Str::of($banner->descp)->limit(250)}}</p>
                    </div>
                    <!--<div class="card-overlay bg-gradient-fade"></div>-->
                </div>
            </div>

            @endforeach
            
            @endif

        </div>
    </div>
</div>

<div class="content mt-0">
    <div class="row">
        @if(Auth::guard('customer')->user()->roles == 1)
        <div class="col-6">
             @if(Auth::guard('customer')->user()->roles == 1 && Auth::guard('customer')->user()->status == 3)
            <a href="{{ route('register', ['id' => encrypt(Auth::guard('customer')->user()->phone)])}}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight" >{{ __('messages.indexbutton1') }}</a>
            @endif
            @if(Auth::guard('customer')->user()->roles == 1 && Auth::guard('customer')->user()->status == 1)
            <a type="button" href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight" >{{ __('messages.indexbutton1') }}</a>
            @endif
            @if(Auth::guard('customer')->user()->roles == 1 && Auth::guard('customer')->user()->status == 2)
            <a type="button" href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight" >{{ __('messages.indexbutton1') }}</a>
            @endif
        </div>
        <div class="col-6">
            <a href="{{ route('checkstatus')}}" class="btn btn-full btn-border btn-m rounded-s text-uppercase font-900 shadow-l border-highlight color-highlight">{{ __('messages.indexbutton2') }}</a>
        </div>
        @else
        <div class="col-6">
            <a href="{{ route('login.opportunity.add')}}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">Pass Requirement</a>
        </div>
        <div class="col-6">
            <a href="{{route('login.media.add')}}" class="btn btn-full btn-border btn-m rounded-s text-uppercase font-900 shadow-l border-highlight color-highlight">New Business Post</a>
        </div>
        @endif
    </div>
</div>

<div class="content mb-3 mt-0">
    <h5 class="float-start font-16 font-500">{{ __('messages.indexsec1head') }}</h5>
    <a class="float-end font-12 color-highlight mt-n1" href="#">{{ __('messages.indexsec1view') }}</a>
    <div class="clearfix"></div>
</div>

<div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-2">
    <div class="splide__track">
        <div class="splide__list">

            @if(!empty($dash['news']))

            @foreach($dash['news'] as $news)

            <div class="splide__slide ps-3">
                <div class="bg-theme pb-3 rounded-m shadow-l text-center overflow-hidden">
                    <div data-card-height="150" class="card mb-2 " style="background-image:url('{{asset('uploads/news')}}/{{$news->image}}');" >
                        <h5 class="card-bottom color-white mb-2">{{Str::of($news->title)->limit(20)}}</h5>
                        <div class="card-overlay bg-gradient"></div>
                    </div>  
                    <p class="mb-3 ps-2 pe-2 pt-2 font-12">{{Str::of($news->descp)->limit(75)}}</p>
                    <!--<a href="#" class="btn btn-xs bg-highlight btn-center-xs rounded-s shadow-s text-uppercase font-900">View</a>-->
                </div>
            </div>

            @endforeach

            @endif

        </div>
    </div>
</div>

<div class="content mb-2">
    <h5 class="float-start font-16 font-500">{{ __('messages.indexsec2head') }}</h5>
    <a class="float-end font-12 color-highlight mt-n1" href="#">{{ __('messages.indexsec2view') }}</a>
    <div class="clearfix"></div>
</div>

<div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-1">
    <div class="splide__track">
        <div class="splide__list">

            @if(!empty($dash['activities']))
            @foreach($dash['activities'] as $activities)

            <div class="splide__slide ps-3">
                <div class="bg-theme rounded-m shadow-m text-center ">
                    <img class="rounded-circle mt-4 mb-4" width="90" height="90" src="{{asset('uploads/activities')}}/{{$activities->image}}">
                    <h5 class="font-16">{{$activities->title}}</h5>
                    <p class="line-height-s font-11  pb-4" >
                        {{Str::of($activities->descp)->limit(40)}}
                    </p>
                </div>
            </div>

            @endforeach
            
            @endif

        </div>
    </div>
</div>
<div class="card preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}">
    <div class="card-body">
        <h4 class="color-white">{{ __('messages.indexsec3head') }}</h4>
        <p class="color-white">
            {{ __('messages.indexsec3descp') }}
        </p>
        <div class="card card-style ms-0 me-0 bg-theme">
            <div class="row m-3">

                @if(!empty($dash['scheme']))

                @foreach($dash['scheme'] as $scheme)
                <div class="col-6">
                    <i class="float-start ms-3 me-3" >
                        <img class="rounded-circle " width="60" height="60" src="{{asset('uploads/scheme')}}/{{$scheme->image}}">
                    </i>
                    <h5 class="color-theme float-start font-13 font-500 line-height-s pb-3 mb-3 ps-2">{{Str::of($scheme->title)->limit(20)}}<br>{{$scheme->count}}</h5>
                </div>
                @endforeach
                
                @endif

            </div>
        </div>
    </div>
    <div class="card-overlay bg-highlight opacity-90"></div>
    <div class="card-overlay dark-mode-tint"></div>
</div>

<div class="card card-style">
    <div class="content text-center">
        <h2 class="text-center">Meetings</h2>
    </div>
    <div class="divider divider-small mb-3 bg-highlight"></div>
   

    <div class="content" id="tab-group-3">
                <div class="tab-controls tabs-small tabs-rounded vbf-opp-tab" data-highlight="bg-red-dark">
                    <a href="#" class="no-effect"  data-bs-toggle="collapse" data-bs-target="#tab-1">Past</a>
                    <a href="#" class="no-effect" data-active data-bs-toggle="collapse" data-bs-target="#tab-2">Today</a>
                    <a href="#" class="no-effect" data-bs-toggle="collapse" data-bs-target="#tab-3">Upcoming</a>
                </div>
                <div class="clearfix mb-3"></div>
                <div data-bs-parent="#tab-group-3" class="collapse" id="tab-1">
                    @foreach($dash['past'] as $event)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{$event->title}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    @endforeach
                    
                     @foreach($dash['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                  
                    @if($event->time < $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{$event->title}}</h2>
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
                    @foreach($dash['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                    @if($event->time >= $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{$event->title}}</h2>
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
                    @foreach($dash['upcoming'] as $event)
                   
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{$event->title}}</h2>
                    <p class="color-black font-10 opacity-70 mt-2 mb-n1"><i class="far fa-calendar"></i> {!! date('F d', strtotime($event->date)) !!} <i class="ms-3 far fa-clock"></i> {!! date('h:i A', strtotime($event->time)) !!}</p>
                    <p class="color-black font-10 opacity-70 text-capitalize"><i class="fa fa-map-marker-alt"></i> {{$event->location}}</p>
                    </div>
                    <div class="card-center me-3">
                    <a href="{{route('login.meetings.detail',['id' => $event->id])}}" class="float-end bg-highlight btn btn-xs text-uppercase font-900 rounded-xl font-11">view</a>
                    </div>
                    
                    </div> 
                    
                    @endforeach
                     @foreach($dash['new'] as $event)
                    @php
                    $ti = date('H:i');
                    @endphp
                    @if($event->time > $ti)
                    <div data-card-height="140" class="card card-style rounded-m shadow-xl ">
                    <div class="card-top mt-4 ms-3">
                    <h2 class="color-black text-uppercase">{{$event->title}}</h2>
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

<div class="card card-style mt-4 shadow-l" data-card-height="250">
    <div class="card-center ps-3 pe-3">

        @if(!empty($dash['content']))
        @php
        $content = $dash['content'];

        @endphp
        <h4 class="color-white">{{$content->title}}</h4>     
        <p class="color-white mb-0 opacity-60">
            {{$content->descp}}
        </p>
        
        @endif
    </div>
    <div class="card-overlay bg-highlight opacity-90"></div>
</div>

@endsection
@section('footer')
@parent
@endsection
@section('footerscript')
@parent
<script>
//Image Sliders
    var splide = document.getElementsByClassName('splide3');
    if(splide.length){
        var singleSlider = document.querySelectorAll('.single-slider');
        if(singleSlider.length){
            singleSlider.forEach(function(e){
                var single = new Splide( '#'+e.id, {
                    type:'loop',
                    autoplay:true,
                    interval:4000,
                    perPage: 1,
                }).mount();
                var sliderNext = document.querySelectorAll('.slider-next');
                var sliderPrev = document.querySelectorAll('.slider-prev');
                sliderNext.forEach(el => el.addEventListener('click', el => {single.go('>');}));
                sliderPrev.forEach(el => el.addEventListener('click', el => {single.go('<');}));
            });
        }

        var doubleSlider = document.querySelectorAll('.double-slider6');
        if(doubleSlider.length){
            doubleSlider.forEach(function(e){
                var double = new Splide( '#'+e.id, {
                    type:'loop',
                    autoplay:true,
                    interval:4000,
                    arrows:false,
                    perPage: 2,
                }).mount();
            });
        }

        var trippleSlider = document.querySelectorAll('.tripple-slider');
        if(trippleSlider.length){
            trippleSlider.forEach(function(e){
                var tripple = new Splide( '#'+e.id, {
                    type:'loop',
                    autoplay:true,
                    padding: {
                        left   :'0px',
                        right: '80px',
                    },
                    interval:4000,
                    arrows:false,
                    perPage: 2,
                    perMove: 1,
                }).mount();
            });
        }
    }

</script>
@endsection

