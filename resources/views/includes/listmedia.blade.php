@extends('includes.master')

@section('headerscript')
@parent
<style>
    .body-main-tag {
   position: fixed;
    right: 47%;
    bottom: 12%;
    z-index: 999;
}
.body-main-tag .icon-xs i {
    width: 99px;
    line-height: 38px;
    font-size: 10px;
}
span.pl-2.ms-2.post {
    font-size: 9px !important;
}
@media (max-width: 575.98px) { 
   .body-main-tag {
   position: fixed;
    right: 39%;
    bottom: 12%;
    z-index: 999;
} 
    
}
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.menu5') }}</h2>
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
 @foreach($data as $media)
<div class="card card-style">
            <a data-card-height="250" class="card preload-img mb-3" data-src="{{asset('uploads/media')}}/{{$media->image}}"  href="{{route('login.media.posts',['id' => $media->id])}}">
                <div class="card-bottom ms-sm-3 ms-0 ps-2 mb-1">
                    <h1 class="color-white mb-n1 text-capitalize">{{$media->title}}</h1>
                    <div class="d-flex">
                        @php
                        $id = $media->cust_id;
                        $cus = DB::table('customers')->select('username as custname')->where('id',$id)->first();
                        $cat = $media->category;
                        $catdata = DB::table('pwa_category')->select('name as catname')->where('id',$cat)->first();
                        @endphp
                        @if($cus)<p class="color-white opacity-60 mb-2 mt-2 pe-2  text-capitalize"><i class="fa fa-user pe-sm-2 pe-1"></i> {{$cus->custname}} </p> @endif
                        @if($catdata)<p class="color-white opacity-60 mb-2 mt-2 ms-sm-4 pe-2 text-capitalize"><i class="fa fa-tag pe-sm-2 pe-0"></i> {{$catdata->catname}} </p>@endif
                        <p class="color-white opacity-60 mb-2 mt-2 ms-sm-4"><i class="fa fa-clock pe-sm-2 pe-1"></i>{!! date('jS F Y', strtotime($media->created_at)) !!}</p>
                    </div>
                </div>
                <div class="card-overlay bg-gradient rounded-0"></div>
            </a>
            <div class="content mt-0">
                 <div class="row mb-0">
                    <div class="col-sm-10 col-8">
                        <p>{{Str::limit($media->descp, 100, $end='...')}}</p>
                    </div>
                    <div class="col-sm-2 col-4">
                        <a href="{{route('login.enquiry.add', ['id'=>$media->cust_id])}}" type="button" class="btn bg-highlight text-white btn-s">Enquire Us</a>
                    </div>
                </div>
                
            </div>
        </div>
        
   @endforeach     
    @if(Auth::guard('customer')->user()->roles == 2)
   <div class="body-main-tag">
        <a href="{{route('login.media.add')}}" class="back-to-top icon icon-xs rounded-sm shadow-l bg-highlight color-white"> <i class="fa fa-camera"> <span class="pl-2 ms-2 post">Add Post</span></i></a>
    </div>
    @endif

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection