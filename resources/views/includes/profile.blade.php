@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.profilehead') }}</h2>
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


<div class="card card-style profile-section">
            <div class="content page-profile-team">
                @php
        $id =  Auth::guard('customer')->user()->id;
        $data = DB::table('customers')->where('id', $id)->first();
        @endphp
                <div class="d-flex justify-content-between">
                    <div>
                        @if($data->profile)
                        <img src="{{asset('uploads/customer')}}/{{$data->profile}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                        @else
                        <img src="{{asset('images/avatars/vbf_profile.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                        @endif
                    </div>
                    <div>
                        <h5 class="mt-3 mb-0 text-capitalize"> {{$data->username}}</h5>
                    <p class=" text-capitalize"> {{$data->reg_id}}</p>
                    </div >
                   
                    
                </div>
                
                 
         <h3 class="mt-4 font-600">Basic Info</h3>
         <div class="divider mt-4 mb-3"></div>
         
        
                
                <div class="row mb-0">
                    
                    @if($data->phone)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Phone</p>
                        <p>{{$data->phone}}</p>
                    </div>
                    @endif
                    
                    @if($data->email)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Email</p>
                        <p>{{$data->email}}</p>
                    </div>
                    @endif
                    
                    
                    
                     @if($data->ward)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Ward</p>
                         @php
                        $id = $data->ward;
                        $cus = DB::table('ward')->where('id',$id)->first();
                        @endphp
                        <p>{{$cus->name}}</p>
                    </div>
                    @endif
                    
                    
                    
                </div>
                
                
                
                
                
                
            </div>
        </div>
        
        <a href="{{route('logout')}}">
        <div class="card card-style profile-section">
            <div class="content page-profile-team">
                <div class="d-flex">
                    <div><img src="{{asset('images/avatars/vbf_out.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50"></div>
                    <div><h5 class="mt-3 mb-0">Logout</h5></div>
                    <div class="ms-auto mt-3"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        </a>

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection