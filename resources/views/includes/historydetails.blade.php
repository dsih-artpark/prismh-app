@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Details</h2>
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
    @php $img = explode(',',$datadetails->image_data); @endphp
<div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/pick')}}//{{$img[0]}}">
<div class="card-bottom ms-3">
</div>
<div class="card-overlay "></div>
</div>
<div class="content mb-0">
    <h1 class="text-center">Larva Survey Details</h1>
    <div class="divider mb-0"></div>
<div class="p-2">
<span class="">{{$datadetails->uid}}</span><br>
<span class="">{{$datadetails->latit}}</span><br>
@if($datadetails->q1)
<span class="">Does breading spot exist ? {{$datadetails->q1}}</span>
@endif
@if($datadetails->q1 == "Yes")
- <span class="">{{$datadetails->waste}}</span><br>
@else
<br>
@endif
<span class="">{{$datadetails->descp}}</span><br>


<span class="">{!! date('d-m-Y', strtotime($datadetails->created_at)) !!}</span><br>
<span class="">{!! date('h:i a', strtotime($datadetails->created_at)) !!}</span>
 
@if($datadetails->q1 == "Yes")
@php
    $dumpdetails =  DB::table('dump')->where('pid', $datadetails->id)->first();
    @endphp
    @if(empty($dumpdetails))
 @if(empty($datadetails->source_reduction))
<div class="text-end"><a href="{{route('login.source-reduction.id', ['id' => $datadetails->id])}}" class="btn btn-sm bg-highlight ">Source Reduction</a></div>
@endif
@endif
@endif
 
</div>
</div>
</div>


@php
    $dumpdetails =  DB::table('dump')->where('pid', $datadetails->id)->first();
    @endphp
    @if($dumpdetails)
<div class="card card-style">
<div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/dump')}}/<?=$dumpdetails->image_data;?>">
<div class="card-bottom ms-3">
</div>
<div class="card-overlay "></div>
</div>
<div class="content mb-0">
    <h1 class="text-center">Spray Details</h1>
    <div class="divider mb-0"></div>
<div class="p-2">
<span class="">{{$dumpdetails->uid}}</span><br>

<span class="">{{$dumpdetails->latit}}</span><br>
<span class="">{!! date('d-m-Y', strtotime($dumpdetails->created_at)) !!}</span><br>
<span class="">{!! date('h:i a', strtotime($dumpdetails->created_at)) !!}</span>

   
</div>
</div>
</div>
@else
 @if($datadetails->source_reduction == "Done")
<div class="card card-style">
<!--<div data-card-height="400" class="card preload-img mb-3" style="height: 400px;"  data-src="{{asset('uploads/pick')}}/<?=$datadetails->source_reduction_img;?>">-->
<!--<div class="card-bottom ms-3">-->
<!--</div>-->
<!--<div class="card-overlay "></div>-->
<!--</div>-->
<div class="content mb-0">
    <h1 class="text-center">Source Reduction Details</h1>
    <div class="divider mb-0"></div>
<div class="p-2">
<span class="">Source Reduction : {{$datadetails->source_reduction}}</span><br>


   
</div>
</div>
</div>
@endif
@endif
                
                
               
                
               
                
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