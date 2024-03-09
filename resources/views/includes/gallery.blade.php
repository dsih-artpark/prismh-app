@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Album</h2>
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
            <div class="content mb-1">
                <!--<h3 class="mb-0 pb-3">{{ __('messages.galleryhead') }}</h3>-->
                           
                <div class="row text-center row-cols-3 mb-0">
                    @foreach($gallery as $gal)
                    <a class="col mb-4" data-gallery="gallery-1" href="{{asset('uploads/gallery/')}}/{{$gal->image}}" target="_blank" width="150" height="150" title="{{$gal->name}}">
                        <img src="{{asset('uploads/gallery/')}}/{{$gal->image}}" data-src="{{asset('uploads/gallery/')}}/{{$gal->image}}" class="preload-img img-fluid rounded-xs" alt="img">
                    </a>
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