@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.newshead') }} Detail</h2>
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

<div class="card card-style">
            <img src="{{asset('uploads/news')}}/{{$news->image}}" class="img-fluid">
            <div class="d-flex mt-n2 ms-3">
                <!--<span class="badge text-uppercase px-2 py-1 bg-red-dark">LIVE COVERAGE</span>-->
            </div>
            <div class="content">
                <div class="content">
                    <h1 class="font-600 font-18 line-height-m">{{$news->title}}</h1>
                    <span class="d-block mb-3">{!! date('d M Y', strtotime($news->updated_at)) !!} <span class="copyright-year"></span>, {!! date('H:i A', strtotime($news->updated_at)) !!}</span>
                    <a href="#" class="shareToFacebook icon icon-xs rounded-sm bg-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="shareToTwitter icon icon-xs rounded-sm bg-twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="shareToWhatsApp icon icon-xs rounded-sm bg-whatsapp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="shareToLinkedIn icon icon-xs rounded-sm bg-linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="shareToMail icon icon-xs rounded-sm bg-mail"><i class="fa fa-envelope"></i></a>
                </div>
                <div class="content">
                    <hr>
                    <p>
                        {{$news->descp}}
                    </p>
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