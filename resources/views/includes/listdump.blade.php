@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>list of Larva Surveys</h2>
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


 <div class="row mb-0">
        @php $cnt = 0; @endphp
         @foreach($data as $res)
    @if($cnt%2==0)
     <div class="col-6 pe-0">
                <div class="card card-style me-2">
                    @php $img = explode(',',$res->image_data); @endphp
                    <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('login.history.detail',['id' => $res->id])}}">
                        <div class="card-bottom mb-2">
                            
                        </div>
                        <div class="card-overlay  rounded-0"></div>
                    </a>
                    <div class="content mt-0">
<span class="color-black">Id : {{$res->uid}}</span><br>
<!--<span class="color-black">Survey Details</span><br>-->
<div class="divider mb-0"></div>

        <span class="color-black">Date : {!! date('d-m-Y ', strtotime($res->created_at)) !!}</span><br>
        <span class="color-black">Time : {!! date('h:i a', strtotime($res->created_at)) !!}</span>

      

                        </div>
                </div>
            </div>
             @elseif($cnt%2<>0)
            <div class="col-6 ps-0">
                <div class="card card-style ms-2">
                     @php $img = explode(',',$res->image_data); @endphp
                    <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('login.history.detail',['id' => $res->id])}}">
                        <div class="card-bottom mb-2">
                            
                        </div>
                        <div class="card-overlay  rounded-0"></div>
                    </a>
                    <div class="content mt-0">
                       <span class="color-black">Id : {{$res->uid}}</span><br>
<!--<span class="color-black">Survey Details</span><br>-->
<div class="divider mb-0"></div>

        <span class="color-black">Date : {!! date('d-m-Y ', strtotime($res->created_at)) !!}</span><br>
        <span class="color-black">Time : {!! date('h:i a', strtotime($res->created_at)) !!}</span>
    


    
                    </div>
                </div>
            </div>
    
   @endif

      
    @php $cnt++;   @endphp
    @endforeach
    </div>
    



@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection