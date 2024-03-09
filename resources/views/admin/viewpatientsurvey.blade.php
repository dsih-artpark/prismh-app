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
                            @if($data->name)
                           <div class="col-md-12 mt-4">
                                
                                <p>Name : <span class="font-primary email_add_5"> {{$data->name}}</span></p>
                            </div>
                            @endif
                            @if($data->phone)
                           <div class="col-md-12 mt-4">
                                
                                <p>Phone : <span class="font-primary email_add_5"> {{$data->phone}}</span></p>
                            </div>
                            @endif
                            @if($data->latit)
                           <div class="col-md-12 mt-4">
                                
                                <p>Latitude & Longitude : <span class="font-primary email_add_5"> {{$data->latit}}</span></p>
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