@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.menu5') }} Detail</h2>
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
            <img src="{{asset('uploads/media')}}/{{$media->image}}" class="img-fluid">
            <div class="d-flex mt-n2 ms-3">
                
            </div>
            <div class="content">
                <div class="content">
                    <h1 class="font-600 font-18 line-height-m">{{$media->title}}</h1>
                    @php
                        $id = $media->cust_id;
                        $cus = DB::table('customers')->select('username as custname')->where('id',$id)->first();
                        $cat = $media->category;
                        $catdata = DB::table('pwa_category')->select('name as catname')->where('id',$cat)->first();
                        @endphp
                        <a href="#" class="color-black opacity-60 mb-2 mt-2 pe-2  text-capitalize"><i class="fa fa-user pe-sm-2 pe-1"></i> {{$cus->custname}}</a>
                        @if(!empty($catdata))
                        <a href="#" class="color-black opacity-60 mb-2 mt-2 ms-sm-4 pe-2 text-capitalize"><i class="fa fa-tag pe-sm-2 pe-0"></i><?= $catdata->catname;?></a>
                        @endif
                        <a href="#" class="color-black opacity-60 mb-2 mt-2 ms-sm-4"><i class="fa fa-clock pe-sm-2 pe-1"></i>{!! date('jS F Y', strtotime($media->created_at)) !!}</a>
                    
                </div>
                <div class="content">
                    <hr>
                    <p>{{$media->descp}}</p>
                    
                    <div class="col-sm-12 text-end">
                        <a href="{{route('login.enquiry.add', ['id'=>$media->cust_id])}}" type="button" class="btn bg-highlight text-white btn-s">Enquire Us</a>
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