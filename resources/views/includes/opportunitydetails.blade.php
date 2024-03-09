@extends('includes.master')

@section('headerscript')
@parent
<style>
     .footer {
        display:none;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

    <div class="page-title page-title-small">

        <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.menu4') }} Detail</h2>
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
       
       <div class="card card-style slip-details-section ">
            <div class="content page-profile-team">
                <div class="d-flex">
                    <div class="align-self-center"><img src="{{url('public/images/avatars/vbf_tab_1.png') }}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="40"></div>
                    <div><p class="mt-2 mb-0 slip-title"> <span class="slip-date ps-1"> Date : </span><?=date('M d  Y', strtotime($list->dat));?>  <?=date('h:i.s A ', strtotime($list->dat));?></p></div>
                    
                </div>
            </div>
        </div>
        <div class="row mx-4 slip-details-box">
           <div class="col-12">
               <h6>From</h6>
               <h1 class="text-capitalize">{{$list->custname}}</h1>
               <p class="mb-0 font-16">{{$list->conname}}</p>
           </div>
           @if(Auth::guard('customer')->user()->roles == 2)
           @if($list->optname != '' )
           <div class="col-6">
                <h2 class="mb-0 refer-title">Referral Type</h2>
                <h5 class="text-capitalize">{{$list->optname}}</h5>
           </div>
           @endif
           @endif
           <div class="col-6">
                <h2 class="mb-0 refer-title">Priorities</h2>
                <h5 class="text-capitalize">{{$list->refname}}</h5>
           </div>
        </div>
        <div class="card card-style ">
            <div class="content ">
                <div class="row contact-details-box">
                    <p class="mb-0 fond-18">Contact Details:</p>
                    <h4 class="text-capitalize">{{$list->opname}}</h4>
                    <a href="tel:+91{{$list->phone}}"><i class="fa fa-phone color-phone"></i> {{$list->phone}} </a>
                </div>
            </div>
        </div>
        <div class="row mx-4" style="margin-bottom:60px;">
            <div class="col-12 pb-3">
                <h5 class="mb-0 refer-title">Comments :</h5>
                <h5 class="mb-0 refer-title-1 pb-3">{{$list->descpname}}</h5>
            </div>
            <!--<a href="#" class="btn btn-m btn-full mb-3 rounded-xs text-uppercase font-900 shadow-s bg-red-dark">Rate of Service</a>-->
         </div>
         
         
    

@endsection

@section('footer')
@parent

@endsection

@section('footerscript')
@parent
@endsection