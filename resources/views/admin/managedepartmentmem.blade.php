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
    
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Department Members</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Department Members</li>
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
                      <h5>Department Members</h5>
                    <div class="mb-3 text-end">
                        <a href="{{route('admindepartmentmem.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Department Members</button>
                        </a>
                    </div>
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="departmentmem" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Department</th>
                            <th>Members</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                             @php
                             $i = 1;
                             
                             @endphp
                            @foreach($department['all'] as $data)
                             @php
                             $dep = $data->depid;
                             $re = DB::table('pwa_department')->select('name as depna')->where('id', $dep)->first();
                             
                             @endphp
                            <tr>
                               <td><?=$i;?></td>
                                <td>{{$re->depna}}</td>
                                <td>
                                    @php
                              $x = explode ("|||", $data->memid);
                              $i = 1;
                              @endphp

                              @foreach($x as $key => $val)
                              
                               @php
                             $id = $val;
                             $cs = DB::table('customers')->select('username as usname')->where('id', $id)->first();
                             
                             @endphp
                              <p class="text-capitalize">{{$cs->usname}}</p>
                              @endforeach
                                </td>
                                <td>
                                     @if($data->status != null)

                        @if($data->status == 1)
                                <span class="badge badge-success"> Activated</span>
            
                            
                           
                            @else
                                <span class="badge badge-danger">Not Activated</span>
                            
            
                            @endif
                            @endif
                                </td>
                                <td>
                                     <a href="'.url('admin/departmentmem/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                   
                                    <a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                           
                                     <a href="'.url('admin/departmentmem/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>
                      
                                </td>
                            </tr>
                             @php
                             $i++;
                             @endphp
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
    
                var table = $('#departmentmem').DataTable();
				
				
				
				// Updates DELETE SCRIPT
				$('body').on('click', '#show-delete', function () {
					var _id = $(this).data("id");
						$.ajax({
								type: "get",
								url: SITEURL + "/admin/departmentmem/delete/"+_id,
								success: function (data) {
									
									var oTable = $('#departmentmem').dataTable();
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