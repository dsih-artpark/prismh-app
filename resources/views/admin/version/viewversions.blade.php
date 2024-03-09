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
                  <h3>Events</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Events</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          
         
          <div class="container-fluid">
               <div class="user-profile">
            <div class="row">
                
                <div class="col-xl-4 col-lg-12 col-md-5 xl-35">
                  <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="row">
                     
                      <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                        <div class="card">
                          <!--<div class="card-header">-->
                          <!--  <h5 class="p-0">-->
                          <!--    <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon13" aria-expanded="true" aria-controls="collapseicon13">Joiners</button>-->
                          <!--  </h5>-->
                          <!--</div>-->
                          <!--<div class="collapse show" id="collapseicon13" data-parent="#accordion" aria-labelledby="collapseicon13">-->
                          <!--  <div class="card-body avatar-showcase filter-cards-view">-->
                          <!--    <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="{{asset('uploads/events')}}/<?=$events->secondary_member_image;?>" alt="#"></div>-->
                              
                          <!--  </div>-->
                          <!--</div>-->
                          
                          
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon11" aria-expanded="true" aria-controls="collapseicon11">Co-joiners</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon11" aria-labelledby="collapseicon11" data-parent="#accordion">
                            <div class="card-body social-list filter-cards-view">
                               
                              
                              
                             
                               

                              @php
                              $x = explode ("|", $events->secondary_member_image);
                              $i = 1;
                              @endphp

                              @foreach($x as $key => $val)
                              
                              
                              
                               
                                
                                
                              <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="{{asset('uploads/events')}}/{{$val}}">
                              <div class="media-body"><span class="d-block">
                                  
                                   @php
                              $xname = explode (",", $events->secondary_member);
                               $iname = 1;
                              @endphp
                              
                              
                              
                              

                              @foreach($xname as $keyname => $valname)
                             
                              @if($i==$iname)
                               {{$valname}}
                              @endif
                              
                               @php
                               $iname++;
                              @endphp
                              
                              @endforeach
                                  
                                  </span></div>
                               
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
                </div>
                <div class="col-xl-8 col-lg-12 col-md-7 xl-65">
                  <div class="row">
                    <!-- profile post start-->
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="media"><img class="img-80 img-thumbnail rounded-circle me-3" src="{{asset('uploads/events')}}/<?=$events->prime_member_image;?>" alt="Generic placeholder image">
                              <div class="media-body align-self-center"><a href="#">
                                  <h5 class="user-name">{{$events->prime_member}}</h5></a>
                                <h6>{{$events->prime_member_desig}}</h6>
                              </div>
                            </div>
                            <div class="post-setting"></div>
                          </div>
                          <div class="post-body">
                               <p>{{$events->descp}}</p>
                            <ul class="post-comment">
                              <li>
                                <label><a href="#"><i class="fa fa-calendar-o"></i><span>{{$events->date}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i class="fa fa-clock-o"></i><span>{{$events->time}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i class="fa fa-map-pin"></i><span>{{$events->location}}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="power"></i><span><?=$events->status== '1' ? "Activated" : "Not-Activated";?></span></a></label>
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