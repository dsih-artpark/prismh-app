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
                  <h3>Member Details</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Member Details</li>
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
                                @if($member->profile)
                                <img class="img-80 img-thumbnail m-r-20  update_img_5" src="{{asset('uploads/customer')}}/<?=$member->profile;?>" alt="Profile Image">
                                @else
                                <img class="img-80 img-fluid m-r-20 rounded-circle update_img_5" src="{{asset('admin/assets/images/user/user.png')}}" alt="">
                                @endif
                              <div class="media-body align-self-center"><a href="#">
                                  <h5 class="user-name text-capitalize">{{$member->username}}</h5></a>
                                @if($member->reg_id)
                                <h6 class="text-capitalize">{{$member->reg_id}}</h6>
                                @endif
                              </div>
                            </div>
                            <div class="post-setting">
                               
                            </div>
                          </div>
                           <div class="post-body">
                              <h3 class="text-capitalize"></h3>
                              
                            <ul class="post-comment text-end">
                              <li>
                                <label><a href="#"><i class="fa fa-calendar-o"></i><span>{!! date('d M Y', strtotime($member->updated_at)) !!}</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i class="fa fa-clock-o"></i><span>{!! date('h:i A', strtotime($member->updated_at)) !!}</span></a></label>
                              </li>
                              
                              <li>
                                <label><a href="#"><i data-feather="power"></i><span><?=$member->roles== '1' ? "Guest" : "Member";?></span></a></label>
                              </li>
                            </ul>
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
                  <ul class="nav nav-tabs border-tab mb-0" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true">Basic</a>
                      <div class="material-border"></div>
                    </li>
                   
                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false">Business </a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false">Reference</a>
                      <div class="material-border"></div>
                    </li>
                   <li class="nav-item"><a class="nav-link" id="brand-top-tab" data-bs-toggle="tab" href="#top-brand" role="tab" aria-controls="top-brand" aria-selected="true">Docs</a>
                      <div class="material-border"></div>
                    </li>
                   
                  </ul>
                  <div class="tab-content" id="top-tabContent">
                    <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        
                        <div class="row">
                            @if($member->phone)
                            <div class="col-md-6 mt-4">
                                <p>Phone : <span class="font-primary email_add_5">{{$member->phone}}</span></p>
                            </div>
                            @endif
                            @if($member->email)
                            <div class="col-md-6 mt-4">
                                <p>Email : <span class="font-primary email_add_5">{{$member->email}}</span></p>
                            </div>
                            @endif
                             @if($member->address)
                            <div class="col-md-6 mt-4">
                                <p>Address : <span class="font-primary email_add_5">{{$member->address}}</span></p>
                            </div>
                            @endif
                            @if($member->paddress)
                            <div class="col-md-6 mt-4">
                                <p>Permanent Address : <span class="font-primary email_add_5">{{$member->paddress}}</span></p>
                            </div>
                            @endif
                            @if($member->gotra)
                            <div class="col-md-6 mt-4">
                                <p>Gotra : <span class="font-primary email_add_5">{{$member->gotra}}</span></p>
                            </div>
                            @endif
                             @if($member->city)
                            <div class="col-md-6 mt-4">
                                <p>City : <span class="font-primary email_add_5">{{$member->city}}</span></p>
                            </div>
                            @endif
                             @if($member->pincode)
                            <div class="col-md-6 mt-4">
                                <p>Pincode : <span class="font-primary email_add_5">{{$member->pincode}}</span></p>
                            </div>
                            @endif
                             @if($member->category)
                              @php
                        $catdetails = DB::table('pwa_category')->where('id',$member->category)->first();
                        @endphp
                        @if($catdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Category : <span class="font-primary email_add_5">{{$catdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                              @if($member->subcategory)
                               @php
                        $subcatdetails = DB::table('pwa_subcategory')->where('id',$member->subcategory)->first();
                        @endphp
                        @if($subcatdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Sub Category : <span class="font-primary email_add_5">{{$subcatdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                             @if($member->chapter)
                              @php
                        $chapdetails = DB::table('pwa_chapter')->where('id',$member->chapter)->first();
                        @endphp
                        @if($chapdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Vahini : <span class="font-primary email_add_5">{{$chapdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                             @if($member->descp)
                            <div class="col-md-6 mt-4">
                                <p>Description : <span class="font-primary email_add_5">{{$member->descp}}</span></p>
                            </div>
                            @endif
                            @if($member->keyword)
                            <div class="col-md-6 mt-4">
                                <p>Keyword : <span class="font-primary email_add_5">{{$member->keyword}}</span></p>
                            </div>
                            @endif
                            @if($member->dob)
                            <div class="col-md-6 mt-4">
                                <p>Date of Birth : <span class="font-primary email_add_5">{{$member->dob}}</span></p>
                            </div>
                            @endif
                            @if($member->gender)
                            <div class="col-md-6 mt-4">
                                <p>Gender : <span class="font-primary email_add_5">{{$member->gender}}</span></p>
                            </div>
                            @endif
                             @if($member->martial)
                            <div class="col-md-6 mt-4">
                                <p>Martial Status : <span class="font-primary email_add_5">
                                    
                                      @if($member->martial == 1)
                                      Married
                                      @else
                                      Unmarried
                                      @endif
                                   
                                    </span></p>
                            </div>
                            @endif
                            @if($member->martial_date)
                            <div class="col-md-6 mt-4">
                                <p>Martial Date : <span class="font-primary email_add_5">{{$member->martial_date}}</span></p>
                            </div>
                            @endif
                        </div>                
                        
                        
                      </div>
                      
                    <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                        
                        <div class="row">
                            @if($member->bname)
                            <div class="col-md-6 mt-4">
                                <p>Name : <span class="font-primary email_add_5">{{$member->bname}}</span></p>
                            </div>
                            @endif
                            @if($member->designation_id)
                              @php
                        $desigdetails = DB::table('pwa_designation')->where('id',$member->designation_id)->first();
                        @endphp
                        @if($desigdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Designation : <span class="font-primary email_add_5">{{$desigdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                             @if($member->nature)
                              @php
                        $natdetails = DB::table('pwa_nature')->where('id',$member->nature)->first();
                        @endphp
                        @if($natdetails)
                             <div class="col-md-6 mt-4">
                                
                                <p>Nature of Business : <span class="font-primary email_add_5">{{$natdetails->name}}</span></p>
                            </div>
                            @endif
                             @endif
                            @if($member->bphone)
                            <div class="col-md-6 mt-4">
                                <p>Phone : <span class="font-primary email_add_5">{{$member->bphone}}</span></p>
                            </div>
                            @endif
                            @if($member->bemail)
                            <div class="col-md-6 mt-4">
                                <p>Email : <span class="font-primary email_add_5">{{$member->bemail}}</span></p>
                            </div>
                            @endif
                             @if($member->baddress)
                            <div class="col-md-6 mt-4">
                                <p>Address : <span class="font-primary email_add_5">{{$member->baddress}}</span></p>
                            </div>
                            @endif
                             @if($member->bdate)
                            <div class="col-md-6 mt-4">
                                <p>Establish Date : <span class="font-primary email_add_5">{{$member->bdate}}</span></p>
                            </div>
                            @endif
                             @if($member->website)
                            <div class="col-md-6 mt-4">
                                <p>Website : <span class="font-primary email_add_5">{{$member->website}}</span></p>
                            </div>
                            @endif
                            
                        </div>
                     
                    </div>
                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                      
                      
                      
                       <div class="row">
                            @if($member->rname)
                            <div class="col-md-6 mt-4">
                                <p>Name : <span class="font-primary email_add_5">{{$member->rname}}</span></p>
                            </div>
                            @endif
                            @if($member->remail)
                            <div class="col-md-6 mt-4">
                                <p>Email : <span class="font-primary email_add_5">{{$member->remail}}</span></p>
                            </div>
                            @endif
                             @if($member->rphone)
                            <div class="col-md-6 mt-4">
                                <p>Phone : <span class="font-primary email_add_5">{{$member->rphone}}</span></p>
                            </div>
                            @endif
                            
                        </div>
                        
                        
                        
                    </div>
                   
                    
                    <div class="tab-pane fade" id="top-brand" role="tabpanel" aria-labelledby="brand-top-tab">
                        
                         <div class="row">
                             
                            @if($member->idproof)
                            <h3 class="mt-4">Personal Details</h3>
                            <div class="col-md-6 mt-2">
                                <p>ID : <span class="font-primary email_add_5">{{$member->idproof}}</span></p>
                                 @if($member->idimage)
                                <a href="{{route('adminmember.download', ['id' => $member->idimage])}}" ><i class="fa fa-download"></i> Download</a>
                                @endif
                            </div>
                            @endif
                             @if($member->idaddress)
                            <h3 class="mt-4">Address Doc</h3>
                            <div class="col-md-6 mt-2">
                                <a href="{{route('adminmember.download', ['id' => $member->idaddress])}}" ><i class="fa fa-download"></i> Download</a>
                            </div>
                            @endif
                            
                            @if($member->breg)
                            <h3 class="mt-4">Business Registration Doc</h3>
                            <div class="col-md-6 mt-2">
                                <a href="{{route('adminmember.download', ['id' => $member->breg])}}" ><i class="fa fa-download"></i> Download</a>
                            </div>
                            @endif
                           
                              @if($member->gst)
                            <h3 class="mt-4">GST / Pan Card</h3>
                            <div class="col-md-6 mt-2">
                                <p>ID : <span class="font-primary email_add_5">{{$member->gst}}</span></p>
                                @if($member->gstcer)
                                <a href="{{route('adminmember.download', ['id' => $member->gstcer])}}" ><i class="fa fa-download"></i> Download</a>
                                @endif
                            </div>
                            @endif
                            
                            @if($member->doc)
                            
                            <h3 class="mt-4">Other Doc</h3>
                            <div class="col-md-6 mt-2">
                               <a href="{{route('adminmember.download', ['id' => $member->doc])}}" ><i class="fa fa-download"></i> Download</a>
                            </div>
                            @endif
                            
                             @if($member->others)
                            @php
                        $docdet = DB::table('pwa_document')->where('id',$member->others)->first();
                        @endphp
                        @if($docdet)
                        
                            <div class="col-md-6 mt-2">
                               <p>Others : <span class="font-primary email_add_5">{{$docdet->name}}</span></p>
                            </div>
                            @endif
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