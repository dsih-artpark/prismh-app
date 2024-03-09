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
     
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Details</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Details</li>
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
                          <div class="post-header mb-0">
                            <div class="">
                                @if($data->image_data)
                                <div class="col-md-12">
                                     
                              <img class="img-100 img-thumbnail" src="{{asset('uploads/pick')}}/{{$data->image_data}}" alt="blog-main">
                              
                        </div>
                         @else
                                <img class="img-80 img-fluid m-r-20 rounded-circle update_img_5" src="{{asset('admin/assets/images/user/user.png')}}" alt="">
                                @endif
                              
                                @if($data->uid)
                                <h6 class="text-capitalize mt-2">#{{$data->uid}}</h6>
                                @endif
                              
                            </div>
                            <div class="post-setting">
                               
                            </div>
                          </div>
                           
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                <div class="col-xl-12 col-lg-12 col-md-12 xl-65">
                  <div class="row">
                    <!-- profile post start-->
                    <div class="col-sm-12">
                      
                      
            <div class="card">
              <div class="row product-page-main">
                <div class="col-sm-12">
                    
                    <!--<h3>More Details</h3>-->
                        
                        <div class="row">
                            @if($data->roles == 1)
                           <div class="col-md-12 mt-4">
                                
                                <p>Asha Worker : <span class="font-primary email_add_5"> {{$data->username}}</span></p>
                            </div>
                            @else
                            <div class="col-md-12 mt-4">
                                
                                <p>User : <span class="font-primary email_add_5"> {{$data->username}}</span></p>
                            </div>
                            @endif
                             @if($data->ward)
                           <div class="col-md-12 mt-4">
                                
                                <p>Ward : <span class="font-primary email_add_5"> {{$data->wardname}}</span></p>
                            </div>
                            @endif
                          @if($data->latit)
                           <div class="col-md-12 mt-4">
                                
                                <p>Latitude & Longitude : <span class="font-primary email_add_5"> {{$data->latit}}</span></p>
                            </div>
                            @endif
                            @if($data->q1 == "Yes")
                           <div class="col-md-12 mt-4">
                                
                                <p>Breeding Spot: <span class="font-primary email_add_5"> {{$data->q1}}</span></p>
                            </div>
                            @else
                            <div class="col-md-12 mt-4">
                                
                                <p>Breeding Spot: <span class="font-primary email_add_5"> {{$data->q1}}</span></p>
                            </div>
                            @endif
                            @if($data->waste)
                           <div class="col-md-12 mt-4">
                                
                                <p>Type of Container : <span class="font-primary email_add_5"> {{$data->waste}}</span></p>
                            </div>
                            @endif
                            @if($data->waste == "Indoor")
                           <div class="col-md-12 mt-4">
                                
                                <p>Indoor of the House : <span class="font-primary email_add_5"> {{$data->indoor}}</span></p>
                            </div>
                            @endif
                            @if($data->waste == "Outdoor")
                           <div class="col-md-12 mt-4">
                                
                                <p>Outdoor of the House : <span class="font-primary email_add_5"> {{$data->outdoor}}</span></p>
                            </div>
                            @endif
                             @if($data->source_reduction)
                           <div class="col-md-12 mt-4">
                                
                                <p>Source Reduction: <span class="font-primary email_add_5"> {{$data->source_reduction}}</span></p>
                            </div>
                           
                            @if($data->source_reduction_img)
                                <div class="col-md-12">
                                     
                              <img class="img-100 img-thumbnail" src="{{asset('uploads/pick')}}/{{$data->source_reduction_img}}" alt="blog-main">
                              
                        </div>
                        @endif
                         @endif
                            @if($data->descp)
                           <div class="col-md-12 mt-4">
                                
                                <p>Remarks : <span class="font-primary email_add_5"> {{$data->descp}}</span></p>
                            </div>
                            @endif
                           
                             
                            
                            
                            
                            
                        
                      
                            
                            
                        </div>                
                        
                        
                     
                  
                 
                  
                  
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