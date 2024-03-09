@extends('includes.user.master')

@section('headerscript')
@parent

@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <!--<a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>-->
    <h2>Dashboard</h2>
    
    <!--<div class="d-xs-block d-sm-block d-md-none d-lg-none d-xl-none text-capitalize" style="position: fixed;top: 32px;color: white;left: 185px;"> {{Auth::guard('customer')->user()->reg_id}}  {{Auth::guard('customer')->user()->username}}</div>-->
    <!--<div class="d-xs-none d-sm-none d-md-block d-lg-block d-xl-block text-capitalize" style="position: fixed;top: 32px;color: white;left: 200px;"> {{Auth::guard('customer')->user()->reg_id}} {{Auth::guard('customer')->user()->username}}</div>-->
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

<div class="card card-style opportunity_section">
            <div class="content">
                <div class="row mb-3">
                    <h2 class="text-center pb-3"></h2>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                     
                     <!--<h1 class="color-highlight mb-0 pb-1"><?=$data['given'];?></h1>-->
                        <!--<h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.dashboardtitle') }}<br> {{ __('messages.dashboardtitle1') }}</h5>-->
                        @php
                        $upid = Auth::guard('customer')->user()->id;
                        $res =  DB::table('dump')->where('cust_id', $upid)->where('created_at','LIke', \Carbon\Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
                        
                        
                        $rest =  DB::table('dump')->where('cust_id', $upid)->where('status', 1)->count();
                       
                        
                        @endphp
                        <h1 class="color-highlight mb-0 pb-1">{{$rest}}</h1>
                        <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">Total Sprayed</h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                       
                         <h1 class="color-highlight mb-0 pb-1">{{$res}}</h1>
                        <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Today Sprayed </h5>
                    </div>
                    
                   
                
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