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
                  <h3>Meetings</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Meetings</li>
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
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="media"><img class="img-80 img-thumbnail  me-3" src="{{asset('uploads/meetings')}}/<?=$meetings->prime_member_image;?>" alt="Generic placeholder image">
                              <div class="media-body align-self-center"><a href="#">
                                  <h5 class="user-name text-capitalize">{{$meetings->prime_member}}</h5></a>
                                <h6 class="text-capitalize">{{$meetings->prime_member_desig}}</h6>
                                @if($meetings->modeid)
                                <p>Meeting Id - {{$meetings->modeid}}</p>
                                @endif
                              </div>
                            </div>
                            <div class="post-setting"></div>
                          </div>
                          <div class="post-body">
                              <h3 class="text-capitalize">{{$meetings->title}}</h3>
                               <p>{{$meetings->descp}}</p>
                               
                               <h3 class="text-capitalize mt-2">Attended Members</h3>
                               @php
                               $mid = $meetings->id;
                               $dataattd = DB::table('pwa_meetings_attendance')->where('mid', $mid)->get();
                               @endphp
                               @if(!$dataattd->isEmpty())
                               @foreach($dataattd as $pma) 
                               @php
                               $custid = $pma->custid;
                               $attd = DB::table('customers')->where('id', $custid)->first();
                               @endphp
                               <p>{{$attd->username}}</p>
                               @endforeach
                               @else
                               <p>NIL</p>
                               @endif
                              
                            <ul class="post-comment">
                              <li>
                                <label><a href="#"><i class="fa fa-calendar-o"></i><span>{{$meetings->date}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i class="fa fa-clock-o"></i><span>{{$meetings->time}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i class="fa fa-map-pin"></i><span class="text-capitalize">{{$meetings->location}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="power"></i><span><?=$meetings->status== '1' ? "Activated" : "Not-Activated";?></span></a></label>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
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