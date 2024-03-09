@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Maintanence</h2>
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
<div class="card card-style">
    <div class="content text-center pt-4">
        <h1></h1>
        <h2 class="pt-4">Maintanence</h2>
       <p class="boxed-text-l">For any technical support kindly contact through <br>WhatsApp message preferably </p>
        <div class="row mb-4">
            <center>
                <div class="col-6 pe-0" class="whatsapp">
                    
                </div>
            </center>
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