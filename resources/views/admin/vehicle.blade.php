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
                  <h3>Registered Vehicles</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">   <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Registered Vehicles</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid" >
            <div class="row">
              <!-- Server Side Processing start-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                     
                    <div class="mb-3 text-end">
                        <a href="{{route('admincampaign.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Vehicles</button>
                        </a>
                    </div>
                   </div>


                    
                    @php $id = session('admin.admin_id'); @endphp

                    @if($id== 1)

                   <div class="row d-inline-flex m-2">
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Zone<span class="text-danger fs-6">*</span> </label>
                        <select class="custom-select form-select" name="zone" id="chosen_zone" required="">
                          <option value="">Select</option>
                          <?php
                              $zoneData = DB::select("Select id, title FROM zone where status=1");                                                

                              foreach($zoneData as $zd)
                              {
                                  $zoneID = $zd->id;
                                  $zoneTitle = $zd->title;

                                  ?>

                                  <option value="{{$zoneID}}">{{$zoneTitle}}</option>    

                                  <?php
                              }
                          ?>
                        </select>
                        <div class="invalid-feedback">Please select a Zone name</div>

                      </div>
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Division <span class="text-danger fs-6">*</span></label>
                        <select class="custom-select form-select" name="mlac" id="chosen_mlac" required="">
                          <option value="">Select</option>
                        </select>
                        <div class="invalid-feedback">Please select a Division name</div>

                      </div>
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select ward<span class="text-danger fs-6">*</span> </label>
                        <select class="custom-select form-select" name="ward" id="chosen_ward" required="">
                          <option value="">Select</option>
                        </select>
                        <div class="invalid-feedback">Please select a Ward name</div>

                      </div>
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Status</label>
                        <select class="custom-select form-select" id="validationCustom04" required="">
                          <option value="">Select</option>
                          <option value="1">Progress</option>
                          <option value="2">Picked Up</option>
                          <option value="3">Dumped</option>
                        </select>
                        <div class="invalid-feedback">Please select a status</div>

                      </div>
                    </div>
                    
                    



                @endif




                  <div class="card-body m-3">
                    <div class="table-responsive">
                     
                      <table class="display" id="regd_vehs" style="width:100%">
                        <thead>
                          <tr>
                            <!-- Old set of table headings -->
                            
                            <!--<th>#</th>
                            <th>Vehicle No</th>
                            <th>Waste Type</th>
                            <th>Picked On</th>
                            <th>Dumped On</th>
                            <th>Status</th>
                            <th>Action</th>-->
                            
                            
                            
                            <!-- New set of table headings -->
                            
                            <th>#</th>
                            <th>Vehicle No</th>
                            <th>Driver Name</th>
                            <th>Owner Name</th>
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
    
    
    
                var table = $('#regd_vehs').DataTable({
					processing:true,
					serverSide:true,
					ajax: {
						url: "{{ url('/admin/regdVehsList') }}"
					},
					columns: [
					    
					    // Old dataset for regd vehs
					    
						/*{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
						{ data: 'Vehicle_num', name: 'Vehicle_num' },
						{ data: 'waste', name: 'waste' },
                        { data: 'Picked_up_on', name: 'Picked_up_on' },
                        { data: 'Dumped_on', name: 'Dumped_on' },
						{ data: 'status', name: 'status' },
					    {data: 'action', name: 'action'},*/
					    
					    // New dataset for regd vehs
					    
					    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
						{ data: 'Vehicle_num', name: 'Vehicle_num' },
						{ data: 'Driver_name', name: 'Driver_name' },
                        { data: 'Owner_name', name: 'Owner_name' },
						{ data: 'status', name: 'status' },
					    { data: 'action', name: 'action'},
					],
					order:[],
					responsive: true
				});
				
				
				
				// Updates DELETE SCRIPT
				/*$('body').on('click', '#show-delete', function () {
					var _id = $(this).data("id");
						$.ajax({
								type: "get",
								url: SITEURL + "/admin/complaints/delete/"+_id,
								success: function (data) {
									
									var oTable = $('#complaints').dataTable();
									oTable.fnDraw(false);
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
					
				});*/


        $('#chosen_zone').on('change', function() 
    {
        var zone_num = this.value;
        $("#chosen_mlac").html('');
        $('#chosen_ward').html('');

        $.ajax({
            url:"{{url('get-divisions-for-reg-vehs')}}",
            type: "GET",

            data: 
            {
                zoneNum: zone_num,
                _token: '{{csrf_token()}}' 
            },

            dataType : 'json',

            success: function(result)
            {
                $('#chosen_mlac').html('<option value="">Select</option>'); 
                $("#chosen_ward").html('<option value="">Select</option>');
                
                $.each(result.divisions,function(key,value)
                {
                    $("#chosen_mlac").append('<option value="'+value.id+'">'+value.name+'</option>');
                }); 
            }
        });
    }); 


    $('#chosen_mlac').on('change', function() 
    {
        var mlac_num = this.value;        
        $("#chosen_ward").html('');

        $.ajax({
            url:"{{url('get-wards-for-reg-vehs')}}",
            type: "GET",

            data: 
            {
                divisionNum: mlac_num,
                _token: '{{csrf_token()}}' 
            },

            dataType : 'json',

            success: function(result)
            {                 
                $('#chosen_ward').html('<option value="">Select</option>'); 
                
                $.each(result.wards,function(key,value)
                {
                    $("#chosen_ward").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }            
        });
    });
				
			});
        
    </script>
    
    	

  
@endsection