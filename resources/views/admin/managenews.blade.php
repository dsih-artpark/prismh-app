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
                  <h3>News</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">News</li>
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
                      <h5>News</h5>
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
                          <div class="mb-3 text-end">
                        <a href="{{route('adminnews.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add News</button>
                        </a>
                    </div>
                           <?php
                       }
                       }
                      }
                      if($rolid == 1){
                          ?>
                          <div class="mb-3 text-end">
                        <a href="{{route('adminnews.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add News</button>
                        </a>
                    </div>
                          <?php
                      }
                       ?>
                    
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="news" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
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
    
                var table = $('#news').DataTable({
					processing:true,
					serverSide:true,
					ajax: {
						url: "{{ url('admin/news') }}"
					},
					columns: [
				// 		{data: 'id', name: 'id'},
						{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
						{ data: 'title', name: 'title' },
						{ data: 'image', name: 'image' },
						{ data: 'status', name: 'status' },
						{data: 'action', name: 'action'},
					],
					order:[],
					responsive: true
				});
				
				
				
				// NEWS DELETE SCRIPT
				$('body').on('click', '#show-delete', function () {
					var _id = $(this).data("id");
						$.ajax({
								type: "get",
								url: SITEURL + "/admin/news/delete/"+_id,
								success: function (data) {
									
									var oTable = $('#news').dataTable();
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