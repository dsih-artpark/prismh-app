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
                  <h3>Permissions</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Permissions</li>
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
                      <h5>Permissions</h5>
                      
                         <div class="mb-3 text-end">
                        <a href="{{route('adminpermissions.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Permissions</button>
                        </a>
                    </div>
                         
                   
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="permissions" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>User</th>
                            <th>Roles</th>
                            <th>Modules</th>
                            <th>Wards</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $z=1; @endphp
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$z}}</td>
                                <td>{{$data->username}}</td>
                                <td>{{$data->rolesname}}</td>
                                <td>
                                    @php 
                                $modules = explode(',',$data->modules);
                                @endphp
                                <ol>
                                     @foreach($modules as $module)
                                    @php 
                          $moduledatas = DB::table('modules')->where('id',$module)->first();
                          @endphp 
                                <li>{{$moduledatas->name}}</li>
                                    @endforeach
                                </ol>
                                    
                                </td>
                                <td>
                                    
                                   @php 
                                $wards = explode(',',$data->ward);
                                @endphp
                                <ol>
                                     @foreach($wards as $ward)
                                    @php 
                          $warddatas = DB::table('ward')->where('id',$ward)->first();
                          @endphp 
                                <li>{{$warddatas->name}}</li>
                                    @endforeach
                                </ol>
                                    
                                </td>
                                <td>
                                    @if($data->status == 1)
                                        <span class="badge badge-success"> Activated</span>
                                    @else
                                        <span class="badge badge-danger">Not Activated</span>
                                    @endif
                                </td>
                                <td>
                                    
                                    <div class = "">
               
                       <a href="{{route('admin.permissions.edit', ['id'=>$data->id ])}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      
                       <a href="{{route('admin.permissions.delete', ['id'=>$data->id])}}" class="btn btn-outline-danger-2x"><i class="icon-trash" ></i></a>
                       
                </div>
                
                                </td>
                            </tr>
                            @php $z++; @endphp
                            @endforeach
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
    
                var table = $('#permissions').DataTable();
				
				
				
				// Updates DELETE SCRIPT
				$('body').on('click', '#show-delete', function () {
					var _id = $(this).data("id");
						$.ajax({
								type: "get",
								url: SITEURL + "/admin/permissions/delete/"+_id,
								success: function (data) {
									
									var oTable = $('#permissions').dataTable();
									oTable.fnDraw(false);
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
					
				});
				
			});
        
    </script>
    
    	

  
@endsection