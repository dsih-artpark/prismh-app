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
          <h3>Member Approvals</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Member Approvals</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid default-dash">
    <div class="row"> 
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">All</h3>
                @php
                $totval = DB::table('customers')->count();
                $res = DB::table('customers')->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $res;
                $cal1 = $fp/$totval;
                $per = $cal1 * 100;
                @endphp
                <div class="progress-gradient-dark" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$totval}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Members</h3>
                @php
                $totval = DB::table('customers')->count();
                $res = DB::table('customers')->where('roles', 2)->where('status', 1)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $res;
                $cal1 = $fp/$totval;
                $per = $cal1 * 100;
                @endphp
                <div class="progress-gradient-success" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$totval}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Guests</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 3)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
              
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $res;
                $cal1 = $fp/$totval;
                $per = $cal1 * 100;
                @endphp
                <div class="progress-gradient-primary" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$totval}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Approvals</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 2)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $res;
                $cal1 = $fp/$totval;
                $per = $cal1 * 100;
                @endphp
                <div class="progress-gradient-warning" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$totval}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Rejected</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 1)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $res;
                $cal1 = $fp/$totval;
                $per = $cal1 * 100;
                @endphp
                <div class="progress-gradient-danger" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$totval}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="row project-cards">
    <div class="col-md-12 project-list">
      <div class="card">
        <div class="row">
          <div class="col-md-12 p-2">
            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>All</a></li>
              <li class="nav-item"><a class="nav-link" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="false"><i class="fa fa-shield"></i>Members</a></li>
             <li class="nav-item"><a class="nav-link" id="guest-tab" data-bs-toggle="tab" href="#guest" role="tab" aria-controls="guest" aria-selected="false"><i class="fa fa-users"></i>Guests</a></li>
             <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>Pending</a></li>
              <li class="nav-item"><a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false"><i class="fa fa-ban" aria-hidden="true"></i>Rejected</a></li>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                        
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($data['all'] as $all)
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$all->username;?></td>
                        <td><?=$all->email;?></td>
                        <td><?=$all->phone;?></td>
                        
                            
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="allmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                  @php $one = 1; $two = 2; @endphp  
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#allmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="allmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          </td>
                          <?php
                      }
                       ?>
                         
                        
                        <td>
                          <div class = "">
                              @php
                              $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                              @endphp
                              @foreach($va as $resd)
                   
                       @if($resd == "Edit")
                       <a href="{{route('adminmember.edit', ['id' => $all->id])}}" class="btn btn-outline-primary-2x">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            @endif
                       
                       @if($resd == "Delete")
                       <a href="#" type="button" class="btn btn-outline-danger-2x" data-bs-toggle="modal" data-bs-target="#deletemodal{{$all->id}}"><i class="icon-trash"></i></a>
                            <div class="modal fade" id="deletemodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                    
                                  <h4>Are you sure want to delete this Memeber?</h4>
                                
                                <div class="mt-2 text-end">
                                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-primary btn-2x" >No</a>
                                    
                                    <a href="{{route('adminmember.delete', ['id' => $all->id])}}"  class="btn btn-danger btn-2x" >Yes</a>
                                 </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                       @endif
                       @if($resd == "View")
                           <a href="{{route('adminmember.view', ['id' => $all->id])}}" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                   @endif
                    @endforeach          
                             
                              </div>
                        </td>
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
                        <th>Member Id</th>
                        <th>Business Name</th>
                        <th>Name</th>
                        <th>Phone</th>
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
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($data['pending'] as $all)
                      
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$all->reg_id;?></td>
                        <td><?=$all->bname;?></td>
                        <td><?=$all->username;?></td>
                        <td><?=$all->phone;?></td>
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
                            @if($all->status == 1 && $all->roles == 2)
                            
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Guest
                            </button>
                            
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                    <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                
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
                            @if($all->status == 1 && $all->roles == 2)
                            
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                              Guest
                            </button>
                            
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                    <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          
                        </td>
                          <?php
                      }
                       ?>
                        
                        <td>
                          <div class = "">
                               @php
                              $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                              @endphp
                              @foreach($va as $resd)
                   
                       @if($resd == "Edit")
                               <a href="{{route('adminmember.edit', ['id' => $all->id])}}" class="btn btn-outline-primary-2x">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            @endif
                       
                       @if($resd == "Delete")
                            <a href="#" type="button" class="btn btn-outline-danger-2x" data-bs-toggle="modal" data-bs-target="#deletepmodal{{$all->id}}"><i class="icon-trash"></i></a>
                            <div class="modal fade" id="deletepmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                    
                                  <h4>Are you sure want to delete this Memeber?</h4>
                                
                                <div class="mt-2 text-end">
                                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-primary btn-2x" >No</a>
                                    <a href="{{route('adminmember.delete', ['id' => $all->id])}}"  class="btn btn-danger btn-2x" >Yes</a>
                                 </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                        @endif
                       @if($resd == "View")
                            <a href="{{route('adminmember.view', ['id' => $all->id])}}" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                          @endif
                    @endforeach    
                           
                        </div>
                        </td>
                        
                      </tr>
                      @php $i++; @endphp
                      @endforeach
                    </tbody>
                    
                  </table>
                  
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
              <div class="row">
                <div class="table-responsive">
                  <table class="display" id="members" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($data['members'] as $all)
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$all->username;?></td>
                        <td><?=$all->email;?></td>
                        <td><?=$all->phone;?></td>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="membermodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success" data-bs-dismiss="modal">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger" data-bs-dismiss="modal">Rejected</button></a></p>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#membermodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="membermodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                   <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                          <?php
                      }
                       ?>
                       
                        <td>
                          <div class = "">
                               @php
                              $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                              @endphp
                              @foreach($va as $resd)
                   
                       @if($resd == "Edit")
                                <a href="{{route('adminmember.edit', ['id' => $all->id])}}" class="btn btn-outline-primary-2x">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            @endif
                       
                       @if($resd == "Delete")
                             <a href="#" type="button" class="btn btn-outline-danger-2x" data-bs-toggle="modal" data-bs-target="#memdeletemodal{{$all->id}}"><i class="icon-trash"></i></a>
                            <div class="modal fade" id="memdeletemodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                    
                                  <h4>Are you sure want to delete this Memeber?</h4>
                                
                                <div class="mt-2 text-end">
                                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-primary btn-2x" >No</a>
                                    <a href="{{route('adminmember.delete', ['id' => $all->id])}}"  class="btn btn-danger btn-2x" >Yes</a>
                                 </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                     @endif
                       @if($resd == "View")
                    <a href="{{route('adminmember.view', ['id' => $all->id])}}" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                          @endif
                    @endforeach   
                              </div>
                        </td>
                      </tr>
                      @php $i++; @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="guest" role="tabpanel" aria-labelledby="guest-tab">
              <div class="row">
                <div class="table-responsive">
                  <table class="display" id="guests" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($data['guest'] as $all)
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$all->username;?></td>
                        <td><?=$all->email;?></td>
                        <td><?=$all->phone;?></td>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="guestmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                 
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#guestmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="guestmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                                 
                                 </div>
                              </div>
                            </div>
                          </div>
                        </td>
                          <?php
                      }
                       ?>
                       
                        <td>
                          <div class = "">
                               @php
                              $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                              @endphp
                              @foreach($va as $resd)
                   
                       @if($resd == "Edit")
                                 <a href="{{route('adminmember.edit', ['id' => $all->id])}}" class="btn btn-outline-primary-2x">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            @endif
                       
                       @if($resd == "Delete")
                             <a href="#" type="button" class="btn btn-outline-danger-2x" data-bs-toggle="modal" data-bs-target="#gusdeletemodal{{$all->id}}"><i class="icon-trash"></i></a>
                            <div class="modal fade" id="gusdeletemodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                    
                                  <h4>Are you sure want to delete this Memeber?</h4>
                                
                                <div class="mt-2 text-end">
                                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-primary btn-2x" >No</a>
                                    <a href="{{route('adminmember.delete', ['id' => $all->id])}}"  class="btn btn-danger btn-2x" >Yes</a>
                                 </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                     @endif
                       @if($resd == "View")
                    <a href="{{route('adminmember.view', ['id' => $all->id])}}" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                         @endif
                    @endforeach   
                         
                              </div>
                        </td>
                      </tr>
                      @php $i++; @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
              <div class="row">
                <div class="table-responsive">
                  <table class="display" id="rejecteds" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($data['rejected'] as $all)
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$all->username;?></td>
                        <td><?=$all->email;?></td>
                        <td><?=$all->phone;?></td>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="rejectedmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                    <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
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
                            @if($all->status == 1 && $all->roles == 2)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Member
                            </button>
                            
                            @elseif($all->status == 2 && $all->roles == 1)
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Pending
                            </button>
                            @elseif($all->status == 1 && $all->roles == 1)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectedmodal{{$all->id}}">
                              Rejected
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" >
                              Guest
                            </button>
                            @endif
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="rejectedmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                     @php $one = 1; $two = 2; @endphp 
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$one}}" ><button  class="btn btn-success badge badge-success">Approved</button></a></p>
                                  <p><a href="{{url('admin/approvals/memberstatus')}}/{{$all->id}}/{{$two}}"><button class="btn btn-danger badge badge-danger">Rejected</button></a></p>
                               </div>
                              </div>
                            </div>
                          </div>
                        </td>
                          <?php
                      }
                       ?>
                        
                        <td>
                          <div class = "">
                               @php
                              $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                              @endphp
                              @foreach($va as $resd)
                   
                       @if($resd == "Edit")
                                 <a href="{{route('adminmember.edit', ['id' => $all->id])}}" class="btn btn-outline-primary-2x">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            @endif
                       
                       @if($resd == "Delete")
                             <a href="#" type="button" class="btn btn-outline-danger-2x" data-bs-toggle="modal" data-bs-target="#rejdeletemodal{{$all->id}}"><i class="icon-trash"></i></a>
                            <div class="modal fade" id="rejdeletemodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body text-center">
                                    
                                  <h4>Are you sure want to delete?</h4>
                                
                                <div class="mt-2 text-end">
                                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-primary btn-2x" >No</a>
                                    <a href="{{route('adminmember.delete', ['id' => $all->id])}}"  class="btn btn-danger btn-2x" >Yes</a>
                                 </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                     @endif
                       @if($resd == "View")
                    <a href="{{route('adminmember.view', ['id' => $all->id])}}" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                         @endif
                    @endforeach   
                         
                              </div>
                        </td>
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
    $('#members').DataTable();
    $('#guests').DataTable();
    $('#rejecteds').DataTable();
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    

    
    // NEWS DELETE SCRIPT
				$('body').on('click', '#show-delete', function () {
					var _id = $(this).data("id");
						$.ajax({
								type: "get",
								url: SITEURL + "/admin/approvals/member/delete/"+_id,
								success: function (data) {
									
								// 	var oTable = $('#all').dataTable();
								// 	oTable.fnDraw(false);
								
								window.location.reload();
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
					
				});

  });
  
</script>

@endsection