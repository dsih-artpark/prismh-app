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
                    <h3>Requirement Approvals</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Requirement Approvals</li>
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
                                <h3 class="font-roboto">Requirments</h3>
                                @php
                                $total = DB::table('opportunity')->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$total}}</h4>
                            </div>
                            <!--<i class="fa fa-users fa-3x"></i>-->
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width:100%" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
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
                                <h3 class="font-roboto">Forwarded</h3>
                                @php
                                $res = DB::table('opportunity')->where('status', 1)->count();
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
                                $res = DB::table('opportunity')->where('status', 2)->count();
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
                                $res = DB::table('opportunity')->where('status', 3)->count();
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
            
        </div>
    </div>
    <!-- Container-fluid starts-->
    
    <div class="row project-cards">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>All</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>Pending</a></li>
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
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Subcategory</th>
                                                <th>Description</th>
                                                <th>Posted By</th>
                                                <th>Forwarded to</th>
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
                                                <td><?=$all->name;?></td>
                                                <td><?=$all->phone;?></td>
                                                <td>
                                                     <?php
                                                    //subcategory
                                                    if($all->subcateid)
                                                    {
                                                        $memdet = DB::table('pwa_subcategory')->where('id', $all->subcateid)->first();
                                                        if($memdet){
                                                        echo $memdet->name;
                                                        } 
                                                    }
                                                    ?>
                                                </td>
                                                <td><?=$all->descp;?></td>
                                                <td><?=$all->username;?></td>
                                                <td>
                                                    <?php
                                                    //members
                                                    if($all->member)
                                                    {
                                                        $memdet = DB::table('customers')->where('id', $all->member)->first();
                                                        if($memdet){
                                                        echo "Member -<br>" .$memdet->username;
                                                        } 
                                                    }
                                                    //category
                                                    else if($all->category){
                                                        $catdet = DB::table('pwa_category')->where('id', $all->category)->first();
                                                        if($catdet){
                                                        echo "Category -<br>" .$catdet->name;
                                                        }
                                                    }
                                                    //chapter
                                                    else if($all->chapter){
                                                        $chapdet = DB::table('pwa_chapter')->where('id', $all->chapter)->first();
                                                        if($chapdet){
                                                        echo "Vahini -<br>" .$chapdet->name;
                                                        }
                                                    }
                                                    else{
                                                         echo "Not Forwaded";
                                                    }
                                                    ?>
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
                                                    <input type="hidden" class="stsupd" value="{{$all->status}}">
                                                    <div class="sts">
                                                        @if($all->status == 1)
                                                        
                                                        <button type="button" class="btn btn-success" data-bs-backdrop="static" data-bs-keyboard="false"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Forwarded
                                                        </button>
                                                        
                                                        @elseif($all->status == 2)
                                                        <button type="button" class="btn btn-warning" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Pending
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Rejected
                                                        </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                
                                                                <div class="modal-body text-center">
                                                                    
                                                                    <div class="aprdiv">
                                                                        <form method="post" action="{{route('adminapprovals.opportunitystatus')}}">
                                                                          @csrf
                                                                          <input type="hidden" name="row" value="{{$all->id}}">
                                                                           <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                            <label for="opportunitytype" class="color-highlight profess-tag">Forward to</label>
                                                                            <select required  class="form-select opportunitytype" id="opportunitytype" name="" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                <option label='Please Select' value=''>Select one</option>
                                                                                <option value="1">Category</option>
                                                                                <option value="2">Members</option>
                                                                                <!--<option value="3">Vahini</option>-->
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="champdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapmember" class="color-highlight profess-tag">Members list</label>
                                                                                <select   class="form-select chapmember profess-tag-1" id="chapmember" data-id="{{$all->id}}" name="member" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="categorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="category" class="color-highlight profess-tag">Category</label>
                                                                                <select   class="form-select category profess-tag-1" id="category" data-id="{{$all->id}}" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                        
                                                                        </div>
                                                                        
                                                                        <div class="subcategorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="subcategory" class="color-highlight profess-tag">Sub Category</label>
                                                                                <select   class="form-select subcategory profess-tag-1" id="subcategory" data-id="{{$all->id}}" name="subcategory" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                        
                                                                        </div>
                                                                        
                                                                        <div class="chapterdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapter" class="color-highlight profess-tag">Vahini list</label>
                                                                                <select   class="form-select chapter profess-tag-1" id="chapter" data-id="{{$all->id}}" name="chapter" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>    
                                                                        <div class="text-end">
                                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                                        </div>
                                                                        
                                                                          
                                                                        </form>
                                                                       
                                                                        
                                                                       
                                                                        
                                                                    </div>   
                                                                     <div class="btnsdiv">
                                                                            <button class="btn btn-success apr" type="submit">Forward</button>
                                                                    <!--<button class="btn btn-danger rej" type="submit" data-id="{{$all->id}}" >Rejected</button>-->
                                                                     <button class="btn btn-danger " >
                                                                        <a class="text-white" href="{{route('adminapprovals.opportunityrejected', ['id' =>$all->id])}}">
                                                            Rejected</a></button>
                                                                    <button class="btn btn-primary btncl" data-bs-dismiss="modal">Close</button>
                                                                    </div>
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
                                                    <input type="hidden" class="stsupd" value="{{$all->status}}">
                                                    <div class="sts">
                                                        @if($all->status == 1)
                                                        
                                                        <button type="button" class="btn btn-success" data-bs-backdrop="static" data-bs-keyboard="false"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Forwarded
                                                        </button>
                                                        
                                                        @elseif($all->status == 2)
                                                        <button type="button" class="btn btn-warning" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Pending
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-toggle="modal" data-bs-target="#exampleModal{{$all->id}}">
                                                            Rejected
                                                        </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                
                                                                <div class="modal-body text-center">
                                                                    
                                                                    <div class="aprdiv">
                                                                        <form method="post" action="{{route('adminapprovals.opportunitystatus')}}">
                                                                          @csrf
                                                                          <input type="hidden" name="row" value="{{$all->id}}">
                                                                           <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                            <label for="opportunitytype" class="color-highlight profess-tag">Forward to</label>
                                                                            <select required  class="form-select opportunitytype" id="opportunitytype" name="opportunitytype" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                <option label='Please Select' value=''>Select one</option>
                                                                                <option value="1">Category</option>
                                                                                <option value="2">Members</option>
                                                                                 <!--<option value="3">Vahini</option>-->
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="champdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapmember" class="color-highlight profess-tag">Members list</label>
                                                                                <select   class="form-select chapmember profess-tag-1" id="chapmember" data-id="{{$all->id}}" name="member" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="categorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="category" class="color-highlight profess-tag">Category</label>
                                                                                <select   class="form-select category profess-tag-1" id="category" data-id="{{$all->id}}" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                        
                                                                        
                                                                        </div>
                                                                        <div class="subcategorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="subcategory" class="color-highlight profess-tag">Sub Category</label>
                                                                                <select   class="form-select subcategory profess-tag-1" id="subcategory" data-id="{{$all->id}}" name="subcategory" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                        
                                                                        </div>
                                                                        <div class="chapterdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapter" class="color-highlight profess-tag">Vahini list</label>
                                                                                <select   class="form-select chapter profess-tag-1" id="chapter" data-id="{{$all->id}}" name="chapter" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>    
                                                                        <div class="text-end">
                                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                                        </div>
                                                                        
                                                                          
                                                                        </form>
                                                                       
                                                                        
                                                                       
                                                                        
                                                                    </div>   
                                                                     <div class="btnsdiv">
                                                                            <button class="btn btn-success apr" type="submit"  >Forward</button>
                                                                    <!--<button class="btn btn-danger rej" type="submit" data-id="{{$all->id}}" >Rejected</button>-->
                                                                     <button class="btn btn-danger " >
                                                                        <a class="text-white" href="{{route('adminapprovals.opportunityrejected', ['id' =>$all->id])}}">
                                                            Rejected</a></button>
                                                                    <button class="btn btn-primary btncl" data-bs-dismiss="modal">Close</button>
                                                                    </div>
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
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Subcategory</th>
                                                <th>Description</th>
                                                <th>Posted By</th>
                                                <th>Forwarded to</th>
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
                                                <td><?=$all->name;?></td>
                                                <td><?=$all->phone;?></td>
                                                <td>
                                                     <?php
                                                    //subcategory
                                                    if($all->subcateid)
                                                    {
                                                        $memdet = DB::table('pwa_subcategory')->where('id', $all->subcateid)->first();
                                                        if($memdet){
                                                        echo $memdet->name;
                                                        } 
                                                    }
                                                    ?>
                                                </td>
                                                <td><?=$all->descp;?></td>
                                                <td><?=$all->username;?></td>
                                                <td>
                                                    <?php
                                                    //members
                                                    if($all->member)
                                                    {
                                                        $memdet = DB::table('customers')->where('id', $all->member)->first();
                                                       if($memdet){
                                                        echo "Member -<br>".$memdet->username;
                                                       }
                                                    }
                                                    //category
                                                    else if($all->category){
                                                        $catdet = DB::table('pwa_category')->where('id', $all->category)->first();
                                                        if($catdet){
                                                        echo "Category -<br>".$catdet->name;
                                                        }
                                                    }
                                                    //chapter
                                                    else if($all->chapter){
                                                        $chapdet = DB::table('pwa_chapter')->where('id', $all->chapter)->first();
                                                        if($chapdet){
                                                        echo "Chapter -<br>".$chapdet->name;
                                                        }
                                                    }
                                                    else{
                                                         echo "Not Forwaded";
                                                    }
                                                    ?>
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
                                                    <input type="hidden" class="stsupd" value="{{$all->status}}">
                                                    <input type="hidden" class="userid" value="{{$all->status}}">
                                                    <div class="sts">
                                                        @if($all->status == 1)
                                                        
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Approved
                                                        </button>
                                                        
                                                        @elseif($all->status == 2)
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Pending
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Rejected
                                                        </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                
                                                                <div class="modal-body text-center">
                                                                    
                                                                    
                                                                    
                                                                    <div class="aprdiv">
                                                                        <form method="post" action="{{route('adminapprovals.opportunitystatus')}}">
                                                                          @csrf
                                                                          <input type="hidden" name="row" value="{{$all->id}}">
                                                                           <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                            <label for="opportunitytype" class="color-highlight profess-tag">Forward to</label>
                                                                            <select required  class="form-select opportunitytype" id="opportunitytype" name="" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                <option label='Please Select' value=''>Select one</option>
                                                                                <option value="1">Category</option>
                                                                                <option value="2">Members</option>
                                                                                 <!--<option value="3">Vahini</option>-->
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="champdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapmember" class="color-highlight profess-tag">Members list</label>
                                                                                <select   class="form-select chapmember profess-tag-1" id="chapmember" data-id="{{$all->id}}" name="member" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="categorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="category" class="color-highlight profess-tag">Category</label>
                                                                                <select   class="form-select category profess-tag-1" id="category" data-id="{{$all->id}}" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                        
                                                                        </div>
                                                                        <div class="text-end">
                                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                                        </div>
                                                                        
                                                                          
                                                                        </form>
                                                                       
                                                                        
                                                                       
                                                                        
                                                                    </div>  
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
                                                    <input type="hidden" class="stsupd" value="{{$all->status}}">
                                                    <input type="hidden" class="userid" value="{{$all->status}}">
                                                    <div class="sts">
                                                        @if($all->status == 1)
                                                        
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Approved
                                                        </button>
                                                        
                                                        @elseif($all->status == 2)
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Pending
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pendingmodal{{$all->id}}">
                                                            Rejected
                                                        </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="pendingmodal{{$all->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                
                                                                <div class="modal-body text-center">
                                                                    
                                                                    
                                                                    
                                                                    <div class="aprdiv">
                                                                        <form method="post" action="{{route('adminapprovals.opportunitystatus')}}">
                                                                          @csrf
                                                                          <input type="hidden" name="row" value="{{$all->id}}">
                                                                           <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                            <label for="opportunitytype" class="color-highlight profess-tag">Forward to</label>
                                                                            <select required  class="form-select opportunitytype" id="opportunitytype" name="" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                <option label='Please Select' value=''>Select one</option>
                                                                                <option value="1">Category</option>
                                                                                <option value="2">Members</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="champdiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="chapmember" class="color-highlight profess-tag">Members list</label>
                                                                                <select   class="form-select chapmember profess-tag-1" id="chapmember" data-id="{{$all->id}}" name="member" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="categorydiv">
                                                                            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                                                                                <label for="category" class="color-highlight profess-tag">Category</label>
                                                                                <select   class="form-select category profess-tag-1" id="category" data-id="{{$all->id}}" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                        
                                                                        </div>
                                                                        <div class="text-end">
                                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                                        </div>
                                                                        
                                                                          
                                                                        </form>
                                                                       
                                                                        
                                                                       
                                                                        
                                                                    </div>  
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div>
                          <button class="btn-close theme-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          <div class="modal-body">
                            <div class="card">
                              <div class="animate-widget">
                                <div><img class="img-fluid" src="{{asset('admin/assets/images/banner/3.jpg')}}" alt=""></div>
                                <div class="text-center p-25">
                                  <p class="text-muted mb-0">Denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings</p>
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
        
        $('.aprdiv').hide();
        
        $('.champdiv').hide();
        
        $('.categorydiv').hide();
        
        $('.chapterdiv').hide();
        
        $('.subcategorydiv').hide();
        
        
        $('body').on('change', '.opportunitytype', function () 
        {
            
            
            if($(this).val() == 3){
                 $('.champdiv').hide();
                $('.categorydiv').hide();
                $('.subcategorydiv').hide();
                $('.chapterdiv').show();
                
                $.ajax({
                    url: '{{route('chapmemberdet.list')}}',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        
                        
                        $(".chapter").html(" ");
                        
                        $(".chapter").append("<option label='Please Select' value=''>Select any one</option>");
                        $.each(data, function(i, item)
                        {
                            $(".chapter").append("<option value="+item.id+">"+item.name+"</option>");      
                        });
                        
                    }
                });
                
            }
            else if($(this).val() == 2){
                
                $('.champdiv').show();
                $('.categorydiv').hide();
                $('.subcategorydiv').hide();
                $('.chapterdiv').hide();
                var row = $('.userid').val();
                
                $.ajax({
                    url: '{{route('memberonly.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, val:row},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        
                        $(".chapmember").html(" ");
                        
                        $(".chapmember").append("<option label='Please Select' value=''>Select any one</option>");
                        $.each(data, function(i, item)
                        {
                            $(".chapmember").append("<option value="+item.id+">"+item.name+" - "+item.categ+"</option>");      
                        });
                        
                    }
                });
                
            }
            else if($(this).val() == 1){
                $('.champdiv').hide();
                $('.categorydiv').show();
                $('.subcategorydiv').hide();
                 $('.chapterdiv').hide();
                
                $.ajax({
                    url: '{{route('oppocategory.list')}}',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        if(data == '')
                        {
                        }
                        else
                        {
                            $(".category").html(" ");
                            $(".category").append("<option label='Please Select' value=''>Select</option>");
                            $.each(data, function(i, item)
                            {
                                $(".category").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
            }
            
            else{
                $('.champdiv').hide();
                $('.categorydiv').hide();
                 $('.chapterdiv').hide();
                 $('.subcategorydiv').hide();
            }
            
        });
        
        
        
        $('.category').on('change', function() 
        {
            
            var category = $(this).val();
            
            
            $.ajax({
                url: '{{route('adminapprovals.listsubcategory')}}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, category:category},
                dataType: 'JSON',
                success: function (data) 
                { 
                    if(data != ''){
                     $('.subcategorydiv').show();
                    
                     $(".subcategory").html(" ");
                        
                        $(".subcategory").append("<option label='Please Select' value=''>Select any one</option>");
                        $.each(data, function(i, item)
                        {
                            $(".subcategory").append("<option value="+item.id+">"+item.name+"</option>");      
                        });
                        
                    }
                    else{
                         $('.subcategorydiv').hide();
                         $(".subcategory").html(" ");
                    }
                    
                }
            });
        });
        
        
        // $('.chapmember').on('change', function() 
        // {
            
        //     var row = $(this).data("id");
        //     var member = $(this).val();
        //     var status = $('.stsupd').val();
            
            
        //     $.ajax({
        //         url: '{{route('adminapprovals.opportunitymemstatus')}}',
        //         type: 'POST',
        //         data: {_token: CSRF_TOKEN, row:row,member:member,status:status},
        //         dataType: 'JSON',
        //         success: function (data) 
        //         { 
                    
        //             window.location.reload();
                    
        //         }
        //     });
        // });
        
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
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        // status change
        $('body').on('click', '.apr', function () {
            
            $('.aprdiv').toggle();
            $('.apr').toggle();
        });
         $('body').on('click', '.btncl', function () {
            
            $('.aprdiv').toggle();
            $('.categorydiv').toggle();
        });
        
        
        
        
        
    });
    
</script>




@endsection