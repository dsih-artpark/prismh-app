@extends('admin.main')

@section('menubar_script')
@parent

<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/scrollbar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/photoswipe.css')}}">

@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')

<div class="page-body">
  
  @if(\Session::get('succes'))
  <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
    <div class="toast defaul-show-toast align-items-center text-white bg-success position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
      <div class="toast-body">{{ \Session::get('succes') }}   
        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  @endif
  {{ \Session::forget('succes') }}
  
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Version</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Version</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  
  
  <div class="container-fluid">
    <div class="user-profile">
      <div class="row">
        
        
        <div class="col-xl-12 col-lg-12 col-md-12 xl-65">
          <div class="row">
            <!-- profile post start-->
            <div class="col-sm-12">
                 @php
                  $x = explode ("||", $appversions->title);
                  $i = 1;
                  @endphp
                  
                  @foreach($x as $key => $val)
                  
                  
                  
                  
                
              <div class="card">
                
                <div class="card-body">
                  
                 
                  <div class="pro-group pt-0 border-0">
                    <div class="product-page-details mt-0">
                      <h3 class="text-capitalize">{{$val}}</h3>
                    </div>
                  </div>
                  
                  @php
                  $xname = explode ("||", $appversions->descp);
                  $iname = 1;
                  @endphp
                  
                  @foreach($xname as $kname => $valname)
                  
                 
                  @if($iname == $i)
                  <div class="pro-group p-2">
                    <p>{{$valname}}</p>
                  </div>
                  @endif
                  
                   @php
                  $iname++;
                  @endphp
                  
                  @endforeach
                  
                  
                 
                  <div class="pro-group p-2 m-2">
                     @php
                  $img = explode ("||", $appversions->image);
                  $iimg = 1;
                  @endphp
                  
                  @foreach($img as $keyname => $imgname)
                  
                  
                  
                    @if($iimg == $i)
                    <img class=" img-thumbnail rounded-m me-3" src="{{asset('uploads/appversions')}}/<?=$imgname;?>" alt="image">
                     @endif
                  
                  
                  
                  @php
                  $iimg++;
                  @endphp
                  
                  @endforeach
                  </div>
                 
                  
                  
                 
                  
                </div>

              </div>
              
              
              
                  
                  
                  
                  
                  
                  
                  
                  
                  @php
                  $i++;
                  @endphp
                  @endforeach
              
              
              
              
              
              
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent



<script src="{{asset('admin/assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('admin/assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('admin/assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>

@endsection