@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.newshead') }}</h2>
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

@foreach($news as $new)
 <div class="card card-style">
            <img src="{{asset('uploads/news')}}/{{$new->image}}" class="img-fluid">
            <!--<div class="d-flex mt-n2 ms-3">-->
            <!--    <span class="badge text-uppercase px-2 py-1 bg-red-dark">LIVE COVERAGE</span>-->
            <!--</div>-->
            <div class="content">
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-600">{{$new->title}}</h4>
                        <p>
                            {{$new->about}}
                        </p>
                    </div>
                    <div class="align-self-center ms-auto">
                        <a href="{{url('login/news/detail')}}/{{$new->news_id}}" class="btn btn-sm bg-highlight text-uppercase font-700 rounded-sm shadow-xl ms-3"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
       
@endforeach
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection