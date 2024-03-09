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
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.memdethead') }}</h2>
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


<div class="card card-style member_directory mt-4 ">
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                    <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                        @if(!empty($memberdetails->profile))
                            <img src="{{asset('uploads/customer/')}}/{{$memberdetails->profile}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                            @else
                            <img src="{{asset('images/avatars/12m.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                            @endif
                        
                    </div>
                    <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point text-capitalize">
                        @php
                            $chk = Auth::guard('customer')->id();
                            
                            @endphp
                            @if($chk == $memberdetails->id)
                            <h5 class="mb-0 text-capitalize">Me</h5>
                            @else
                            <h5 class="mb-0 text-capitalize">{{$memberdetails->username}}</h5>
                            @endif
                        <p class="mb-0 member-dir-1"><b>{{$memberdetails->reg_id}}</b></p>
                        <p class="mb-0 member-dir-1 place-title  "><b>{{$memberdetails->city}}</b></p>
                       
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card card-style member_directory mt-4 " style="margin-bottom:80px">
            <div class="content page-profile-team text-capitalize">
                @if($memberdetails->category)
                @php
                $cat = DB:: table('pwa_category')->where('id', $memberdetails->category)->first();
                @endphp
                 @if(isset($cat))
                <div class="row mb-0 align-items-center">
                  <div class="member-dir-1 place-title"><b>Category</b>
                  <span class="ps-2 detail-des"> : {{$cat->name}}</span>
                  </div>  
                </div>
                @endif
                @endif
                @if($memberdetails->subcategory)
                @php
                $sub = DB:: table('pwa_subcategory')->where('id', $memberdetails->subcategory)->first();
                @endphp
                @if(isset($sub))
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Subcategory</b><span class="ps-2 detail-des"> : {{$sub->name}}</span></div>  
                </div>
                @endif
                @endif
                @if($memberdetails->chapter)
                @php
                $chap = DB:: table('pwa_chapter')->where('id', $memberdetails->chapter)->first();
                @endphp
                 @if(isset($chap))
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Vahini</b><span class="ps-2 detail-des"> : {{$chap->name}}</span></div>  
                </div>
                @endif
                @endif
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Member Since</b><span class="ps-2 detail-des"> : {!! date('d-m-Y', strtotime($memberdetails->updated_at)) !!}</span></div>  
                </div>
                @if($memberdetails->email)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Email</b><span class="ps-2 detail-des"> : {{$memberdetails->email}}</span></div>  
                </div>
                @endif
                @if($memberdetails->phone)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Phone No</b><span class="ps-2 detail-des"> : {{$memberdetails->phone}}</span></div>  
                </div>
                @endif
                @if($memberdetails->website)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Website</b><span class="ps-2 detail-des"> :  {{$memberdetails->website}}</span></div>  
                </div>
                @endif
                <!--<div class="row mb-0 align-items-center mt-3">-->
                <!--    <div class="member-dir-1 place-title"><b>Average Rating</b><span class="ps-2 detail-des"> : </span></div>  -->
                <!--</div>-->
                @if($memberdetails->descp)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Description</b> :
                        <p class="pt-1">{{$memberdetails->descp}}</p>
                    </div>  
                </div>
                @endif
                 @if($memberdetails->address)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Address</b> :
                        <p class="pt-1">{{$memberdetails->address}}</p>
                    </div>  
                </div>
                @endif
                 @if($memberdetails->keyword)
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Keyword</b> :
                        <p class="pt-1"> {{$memberdetails->keyword}}</p>
                    </div>  
                </div>
                @endif
                @if($memberdetails->state)
                @php
                $stat = DB:: table('pwa_state')->where('id', $memberdetails->state)->first();
                @endphp
                 @if(isset($stat))
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>State</b><span class="ps-2 detail-des"> : {{$stat->name}}</span></div>  
                </div>
                @endif
                @endif
                @if($memberdetails->country)
                @php
                $cnt = DB:: table('pwa_country')->where('id', $memberdetails->country)->first();
                @endphp
                 @if(isset($cnt))
                <div class="row mb-0 align-items-center mt-3">
                    <div class="member-dir-1 place-title"><b>Country</b><span class="ps-2 detail-des"> : {{$cnt->name}}</span></div>  
                </div>
                @endif
                @endif
            </div>
        </div>



@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection