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
                  <h3>Breeding Spot Details</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Breeding Spot Details</li>
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
                            <div class="media">
                                @if($data->image_data)
                                <img class="img-80 img-thumbnail m-r-20  update_img_5" src="{{asset('uploads/pick')}}/<?=$data->image_data;?>" alt="Profile Image">
                                @else
                                <img class="img-80 img-fluid m-r-20 rounded-circle update_img_5" src="{{asset('admin/assets/images/user/user.png')}}" alt="">
                                @endif
                              <div class="media-body align-self-center"><a href="#">
                                  <h5 class="user-name text-capitalize">{{$data->username}}</h5></a>
                                @if($data->uid)
                                <h6 class="text-capitalize">{{$data->uid}}</h6>
                                @endif
                              </div>
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
                      
                      <p>
                          @if($data->descp)
                                    {{$data->descp}}
                                    
                                    @else
                                   -
                                    @endif
                      </p>
                      
                      
                      
                      
                      
            
            
            
            <div class="card">
              <div class="row product-page-main">
                <div class="col-sm-12">
                    
                    <h3>More Details</h3>
                        
                        <div class="row">
                            
                             @if($data->uid)
                              @php
                        $catdetails = DB::table('dump')->where('id',$data->category)->first();
                        @endphp
                        @if($catdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Category : <span class="font-primary email_add_5">{{$catdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                              @if($data->subcategory)
                               @php
                        $subcatdetails = DB::table('pwa_subcategory')->where('id',$data->subcategory)->first();
                        @endphp
                        @if($subcatdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Sub Category : <span class="font-primary email_add_5">{{$subcatdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                             @if($data->chapter)
                              @php
                        $chapdetails = DB::table('pwa_chapter')->where('id',$data->chapter)->first();
                        @endphp
                        @if($chapdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Vahini : <span class="font-primary email_add_5">{{$chapdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                             @if($data->descp)
                            <div class="col-md-6 mt-4">
                                <p>Description : <span class="font-primary email_add_5">{{$data->descp}}</span></p>
                            </div>
                            @endif
                            @if($data->keyword)
                            <div class="col-md-6 mt-4">
                                <p>Keyword : <span class="font-primary email_add_5">{{$data->keyword}}</span></p>
                            </div>
                            @endif
                            @if($data->dob)
                            <div class="col-md-6 mt-4">
                                <p>Date of Birth : <span class="font-primary email_add_5">{{$data->dob}}</span></p>
                            </div>
                            @endif
                            @if($data->gender)
                            <div class="col-md-6 mt-4">
                                <p>Gender : <span class="font-primary email_add_5">{{$data->gender}}</span></p>
                            </div>
                            @endif
                             @if($data->martial)
                            <div class="col-md-6 mt-4">
                                <p>Martial Status : <span class="font-primary email_add_5">
                                    
                                      @if($data->martial == 1)
                                      Married
                                      @else
                                      Unmarried
                                      @endif
                                   
                                    </span></p>
                            </div>
                            @endif
                            @if($data->martial_date)
                            <div class="col-md-6 mt-4">
                                <p>Martial Date : <span class="font-primary email_add_5">{{$data->martial_date}}</span></p>
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