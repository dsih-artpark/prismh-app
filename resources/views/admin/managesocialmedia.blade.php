@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
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
    
    @if(\Session::get('error'))
    <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
        <div class="toast defaul-show-toast align-items-center text-white bg-danger position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
            <div class="toast-body">{{ \Session::get('error') }}   
                <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    {{ \Session::forget('error') }}
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Business Post Approvals</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Business Post Approvals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid default-dash">
        <div class="row"> 
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Business Post</h3>
                                @php
                                $total = DB::table('media')->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$total}}</h4>
                            </div>
                            <!--<i class="fa fa-users fa-3x"></i>-->
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-dark" role="progressbar" style="width:100%" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Approved</h3>
                                @php
                                $res = DB::table('media')->where('status', 1)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                @php
                                $fp = $res;
                                $cal1 = $fp/$total;
                                $per = $cal1 * 100;
                                @endphp
                                <div class="progress-gradient-success" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Pending</h3>
                                @php
                                $res = DB::table('media')->where('status', 2)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                @php
                                $fp = $res;
                                $cal1 = $fp/$total;
                                $per = $cal1 * 100;
                                @endphp
                                <div class="progress-gradient-secondary" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Rejected</h3>
                                @php
                                $res = DB::table('media')->where('status', 3)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                @php
                                $fp = $res;
                                $cal1 = $fp/$total;
                                $per = $cal1 * 100;
                                @endphp
                                <div class="progress-gradient-danger" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Expired</h3>
                                @php
                                $res = DB::table('media')->where('status', 4)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                @php
                                $fp = $res;
                                $cal1 = $fp/$total;
                                $per = $cal1 * 100;
                                @endphp
                                <div class="progress-gradient-primary" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        
        <div class="row project-cards">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>All</a></li>
                                <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>Pending</a></li>
                                <li class="nav-item"><a class="nav-link " id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Rejected</a></li>
                                <li class="nav-item">
                                    <a class="nav-link " id="expired-top-tab" data-bs-toggle="tab" href="#top-expired" role="tab" aria-controls="top-expired" aria-selected="true">
                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M21.1712 14.6755H17.2845C15.8693 14.6755 14.7217 13.5279 14.7217 12.1117C14.7217 10.6964 15.8693 9.54883 17.2845 9.54883H21.1407" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17.7219 12.0531H17.4248" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.6062 8.14367H11.6662" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.71411 12.2532C2.71411 5.8484 5.03887 3.71411 12.0151 3.71411C18.9903 3.71411 21.3151 5.8484 21.3151 12.2532C21.3151 18.657 18.9903 20.7922 12.0151 20.7922C5.03887 20.7922 2.71411 18.657 2.71411 12.2532Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
                                        Expired
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                <div class="row">
                                    <div class="table-responsive">
                                        
                                        <table class="display" id="all" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Posted By</th>
                                                     <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                         <th>Status</th>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                          <th>Status</th>
                          <?php
                      }
                       ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($data['all'] as $all)
                                                
                                                <tr>
                                                    <td><?=$i;?></td>
                                                    <td><?=$all->uid;?></td>
                                                    <td><?=$all->title;?></td>
                                                    <td>
                                                        <img src="{{asset('uploads/media')}}/{{$all->image}}" class="rounded-circle" width="100" height="100">
                                                    </td>
                                                    <td> <p><?=$all->custname;?></p>
                                                        <p>{!! date('d M Y', strtotime($all->created_at)) !!}</p>
                                                    </td>
                                                    
                                                     <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                        <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                             @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1" ><button type="button" class="btn btn-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2"><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          
                          ?>
                          
                         
                        <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                             @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1" ><button type="button" class="btn btn-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2"><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                          <?php
                      }
                       ?>
                                                    
                                                    
                                                </tr>
                                                @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                <div class="row">
                                    <div class="table-responsive">
                                        
                                        <table class="display" id="pending" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Posted By</th>
                                                     <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                         <th>Status</th>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                          <th>Status</th>
                          <?php
                      }
                       ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($data['pending'] as $all)
                                                
                                                <tr>
                                                    <td><?=$i;?></td>
                                                    <td><?=$all->uid;?></td>
                                                    <td><?=$all->title;?></td>
                                                    <td>
                                                        <img src="{{asset('uploads/media')}}/{{$all->image}}" class="rounded-circle" width="100" height="100">
                                                    </td>
                                                    <td> <p><?=$all->custname;?></p>
                                                        <p>{!! date('d M Y', strtotime($all->created_at)) !!}</p>
                                                    </td>
                                                    <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                        <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1"  ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                         <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1"  ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                          <?php
                      }
                       ?>
                                                   
                                                    
                                                </tr>
                                                @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                <div class="row">
                                    <div class="table-responsive">
                                        
                                        <table class="display" id="rejected" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Posted By</th>
                                                    <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                         <th>Status</th>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                          <th>Status</th>
                          <?php
                      }
                       ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($data['rejected'] as $all)
                                                
                                                <tr>
                                                    <td><?=$i;?></td>
                                                    <td><?=$all->uid;?></td>
                                                    <td><?=$all->title;?></td>
                                                    <td>
                                                        <img src="{{asset('uploads/media')}}/{{$all->image}}" class="rounded-circle" width="100" height="100">
                                                    </td>
                                                    <td> <p><?=$all->custname;?></p>
                                                        <p>{!! date('d M Y', strtotime($all->created_at)) !!}</p></td>
                                                     <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                        <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif         
                                                        </div>
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="rejecteedmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1" ><button class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </td>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                         <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rejecteedmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif         
                                                        </div>
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="rejecteedmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1" ><button class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </td>
                          <?php
                      }
                       ?>
                                                    
                                                    
                                                </tr>
                                                @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                             <div class="tab-pane fade" id="top-expired" role="tabpanel" aria-labelledby="expired-top-tab">
                                <div class="row">
                                    <div class="table-responsive">
                                        
                                        <table class="display" id="expired" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Posted By</th>
                                                     <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                         <th>Status</th>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                          <th>Status</th>
                          <?php
                      }
                       ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($data['expired'] as $all)
                                                
                                                <tr>
                                                    <td><?=$i;?></td>
                                                    <td><?=$all->uid;?></td>
                                                    <td><?=$all->title;?></td>
                                                    <td>
                                                        <img src="{{asset('uploads/media')}}/{{$all->image}}" class="rounded-circle" width="100" height="100">
                                                    </td>
                                                    <td>
                                                        <p><?=$all->custname;?></p>
                                                        <p>{!! date('d M Y', strtotime($all->created_at)) !!}</p>
                                                        
                                                    </td>
                                                    <?php
                      $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                           ?>
                        <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                            @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1"  ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                         <td>
                                                        <div class="sts">
                                                            @if($all->status == 1)
                                                            
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Approved
                                                            </button>
                                                            
                                                            @elseif($all->status == 2)
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Pending
                                                            </button>
                                                             @elseif($all->status == 3)
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Rejected
                                                            </button>
                                                            @else
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                                Expired
                                                            </button>
                                                            @endif
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-body text-center">
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/1"  ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/2" ><button class="btn btn-warning badge badge-warning">Pending</button></a></p>
                                                                        
                                                                        <p><a href="{{url('admin/approvals/socialmediastatus')}}/{{$all->id}}/3" ><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                          <?php
                      }
                       ?>
                                                   
                                                    
                                                </tr>
                                                @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                        
                                        
                                        
                                        
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

<script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

<script type="text/javascript">
    
    "use strict";
    
    $(document).ready(function(){
        
        // Variables
        var SITEURL = '{{url('')}}';
        
        // Csrf Field
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#all').DataTable();
        $('#pending').DataTable();
        $('#rejected').DataTable();
         $('#expired').DataTable();
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        
        
        
        
        
        
    });
    
</script>




@endsection