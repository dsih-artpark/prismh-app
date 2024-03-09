@extends('includes.user.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2>Details</h2>
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
@foreach($datadetail as $datadetails)



<div class="col-6 pe-0">
                <div class="card card-style me-2">
<div data-card-height="200" class="card preload-img mb-3" style="height: 200px;"  data-src="{{asset('uploads/pick')}}/<?=$datadetails->image_data;?>">

<div class="card-overlay "></div>
</div>
<div class="content mb-0">
<div class="text-start">
    <h1>Pick Details</h1>
    <div class="divider"></div>
<span class="">{{$datadetails->uid}}</span><br>
<span class=""> {{$datadetails->waste}}</span><br>

<span class="">{{$datadetails->descp}}</span><br>

<span class="">{{$datadetails->phone}}</span><br>

<span class="">{{$datadetails->latit}}</span><br>

<span class="">{!! date('d-m-Y', strtotime($datadetails->created_at)) !!}</span>
<span class="">{!! date('h:i a', strtotime($datadetails->created_at)) !!}</span>

</div>
</div>
</div>
            </div>
            
            
            
            
            

@php
    $dumpdetails =  DB::table('dump')->where('pid', $datadetails->id)->first();
    @endphp
    @if($dumpdetails)
    
    
    <div class="col-6 ps-0">
                <div class="card card-style ms-2">
<div data-card-height="200" class="card preload-img mb-3" style="height: 200px;"  data-src="{{asset('uploads/dump')}}/<?=$dumpdetails->image_data;?>">
<div class="card-overlay "></div>
</div>
<div class="content mb-0">
<div class="text-start">
    <h1>Dump Details</h1>
    <div class="divider"></div>
<span class="">{{$dumpdetails->uid}}</span><br>
<span class="">{{$dumpdetails->latit}}</span><br>
<span class="">{{$dumpdetails->descp}}</span><br>
<span class="">{!! date('d-m-Y', strtotime($dumpdetails->created_at)) !!}</span>
<span class="">{!! date('h:i a', strtotime($dumpdetails->created_at)) !!}</span>
   
</div>
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