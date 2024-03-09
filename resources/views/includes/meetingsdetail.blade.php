@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Meeting Details</h2>
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
                    <div class="content mb-4 text-center">
                        <h3 class="text-capitalize">{{$meetings->title}}</h3>
                        <p>
                            {{$meetings->descp}}
                        </p>
                        <div class="row mb-0 pt-3 bg-highlight">
                            <div class="col-3">
                                <p class="text-start color-white mb-0 pb-3 text-capitalize"><i class="fa fa-map-marker color-white me-2"></i>{{$meetings->location}}</p>
                            </div>
                            <div class="col-3">
                                <p class="text-center color-white mb-0 pb-3"><i class="fa fa-calendar-alt me-2 color-white"></i>{!! date('d M', strtotime($meetings->date)) !!}</p>
                            </div>
                            <div class="col-3">
                                <p class="text-end color-white mb-0 pb-3"><i class="fa fa-clock me-2 color-white"></i>{{$meetings->time}}</p>
                            </div>
                            <div class="col-3">
                                <p class="text-end color-white mb-0 pb-3"><i class="fa-solid fa-spinner me-2 color-white"></i>{{$meetings->mode}}</p>
                            </div>
                           
                        </div>
                        <div class="divider"></div>
                        <div class="d-flex">
                            <div class="w-35 border-right pe-3 border-highlight">
                                <!--<img src="images/empty.png" data-src="{{asset('uploads/meetings')}}/<?=$meetings->prime_member_image;?>" width="80" class="rounded-circle bg-highlight preload-img">-->
                                <h2 class=" mt-2 text-center text-capitalize">{{$meetings->prime_member}}</h2>
                                <h6 class="color-highlight mt-n2  text-center mb-0 pb-0 text-capitalize">{{$meetings->prime_member_desig}}</h6>
                            </div>
                           
                        </div>
                        <div class="divider"></div>
                        <h3 class="text-capitalize">Agenda</h3>
                        <!--<p>{{$meetings->details}}</p>-->
                        {!! html_entity_decode($meetings->details) !!}
                        
                            
                        
        
                    </div>
                </div>
                
                
               
                
               
                
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent

<script type="text/javascript">

    $(document).ready(function(){
        
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$('.momres').hide();

$('.momdiv').on('click',function(){
    // alert($(this).html());
    $('.momres').toggle();
});

});
    
</script>
@endsection