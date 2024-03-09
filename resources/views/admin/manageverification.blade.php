@extends('admin.main')

@section('menubar_script')
@parent
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
    <style>
      .card .card-body {
          padding:30px!important;
      }
 </style>
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
                  <h3>Verification</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Verification</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Server Side Processing start-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                      <h5>Verification</h5>
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="verify" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>UID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @php 
                            $z = 1; 
                            $rolid = session('admin.admin_id');
                            @endphp
                             
                        @if($rolid == 1)
                            
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$z}}</td>
                                <td>{{$data->uid}}</td>
                                <td><?= date("d-m-Y", strtotime($data->created_at));?></td>
                                <td><?= date("h:i a", strtotime($data->created_at));?></td>
                                <td> 
                                <?php
                                    $dumpdata =   DB::table('cdverify')->where('did', $data->id)->first();
                                    
                                    if(!empty($dumpdata)){
                                    
                                    if($dumpdata->status == 1){
                                    echo'<a href="#" class="btn btn-success"> Verified</a>';
                                    
                                    }
                                    
                                    else if($dumpdata->status == 2){
                                    echo'<a href="#" class="btn btn-danger">Notice</a>';
                                    }
                                    
                                    }
                                    else{
                                        echo '<a href="'.url('admin/verification/' . $data->id).'" class="btn btn-success"> Verify</a>';
                                    }
                                    ?>
                    </td>
                            </tr>
                            @php $z++; @endphp
                            @endforeach
                        @endif
                        
                        @php $r = 1;  @endphp
                        @if($rolid > 1)
                        
                            @foreach($datas as $data)
                            
                        @php
                            $pdetails = DB::table('permissions')->where('admin_id', $rolid)->first();
                        @endphp
                         @if(($data->zone == $pdetails->zone) && ($data->division == $pdetails->division) && ($data->ward == $pdetails->ward))
                            <tr>
                                <td>{{$r}}</td>
                                <td>{{$data->uid}}</td>
                                <td><?= date("d-m-Y", strtotime($data->created_at));?></td>
                                <td><?= date("h:i a", strtotime($data->created_at));?></td>
                                <td> 
                                <?php
                                    $dumpdata =   DB::table('cdverify')->where('did', $data->id)->first();
                                    
                                    
                                    if(!empty($dumpdata)){
                                    
                                    if($dumpdata->status == 1){
                                    echo '<a href="#" class="btn btn-success"> Verified</a>';
                                    
                                    }
                                    
                                    else if($dumpdata->status == 2){
                                    echo '<a href="#" class="btn btn-danger">Notice</a>';
                                    }
                                    
                                    }
                                    else{
                                        echo '<a href="'.url('admin/verification/' . $data->id).'" class="btn btn-success"> Verify</a>';
                                    }
                                    ?>
                    </td>
                            </tr>
                         @endif
                         
                             @php $r++; @endphp
                            @endforeach
                            @endif
                        </tbody>
                        
                      </table>
                      
                      
                      
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- Server Side Processing end-->
              
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
    
                var table = $('#verify').DataTable();
				
				
			});
        
    </script>
    
    	

  
@endsection