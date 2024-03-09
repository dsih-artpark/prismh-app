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
     
    <?php
    foreach($regdVehDets as $rvd)
    {
        $custID = $rvd->id;
        $custPhone = $rvd->phone;
        $vehNum = $rvd->vno;
        $vehPhoto = $rvd->vimage;
        
        $ownerName = $rvd->oname;
        $ownerPhnum = $rvd->ophone;
        $ownerAddr = $rvd->address;
        $ownerPhoto = $rvd->oimage;
        $ownerAadharNum = $rvd->oadr;
        $ownerAadharImg = $rvd->oadrimage;
        
        $driverName = $rvd->dname;
        $driverPhnum = $rvd->dphone;
        $driverAddr = $rvd->daddress;
        $driverLicenseNum = $rvd->lcno;
        $driverLicensePhoto = $rvd->lcimage;
        $driverAadharNum = $rvd->dadr;
        $driverAadharImg = $rvd->dadrimage;
        
        $qrc = $rvd->qrcode;
    }
    ?>
     
     
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
            <div class="col-xxl-12 col-lg-12 col-md-12 m-3">
                    <div class="col-sm-12">
                      <div class="card shadow m-3">
<div class="card-body add-post">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <label for="input-text-1" style='margin-left: 10px'>Customer Phone Number</label>
                                <input type="text" class="form-control btn-square" placeholder="Enter Customer phone number" value="{{$custPhone}}" readonly style="margin-left:10px" />
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-3 draggable">
                                <label class="form-label " for="validationCustom02">Vehicle Number</label>
                                <input type="text" class="form-control btn-square" placeholder="Enter Vehicle number" value="{{$vehNum}}" readonly />
                            </div>

                            <!--<div class="col-lg-4 col-sm-12 mb-3 draggable">
                                <label class="form-label " for="validationCustom02">Vehicle Photo</label>
                                <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$vehPhoto}}" style="width: 150px; height:80px" />
                            </div>-->
                        </div>
</div>
<div class="card-body add-post">
                        <div class="card-header pb-0">
                          <h3 class="text-center"> Vehicle Owner Details </h3>
                        </div>
                    </div>    
                        <div class="card-body m-3">
                          <div class="row">
                            <div class="col-12">
                                                  
                                  <div class="row">
                                      
                                        <div class="col-lg-4 col-sm-12">
                                            <label for="input-text-1">Name</label>
                                            <input type="text" class="form-control btn-square" value="{{$ownerName}}" readonly />
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-12">
                                            <label for="input-text-1">Phone</label>
                                            <input type="text" class="form-control btn-square" value="{{$ownerPhnum}}" readonly />
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-12">
                                            <label for="input-text-1">Address</label>
                                            <input type="text" class="form-control btn-square" value="{{$ownerAddr}}" readonly />
                                        </div>
                                        
                                        <!--<div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                             <label class="form-label" for="validationCustom02">Photo</label>
                                             <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$ownerPhoto}}" style="width: 150px; height:80px" />
                                        </div>-->
                                        
                                        <div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                            <label for="input-text-1">Aadhar Number</label>
                                            <input type="text" class="form-control btn-square" value="{{$ownerAadharNum}}" readonly />
                                        </div>

                                        <!--<div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                            <label class="form-label " for="validationCustom02">Aadhar Image</label>
                                            <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$ownerAadharImg}}" style="width: 150px; height:80px" />
                                        </div>-->  
                                      </div>



                                      <div class="row mt-3">
                                        <h3 class=" fw-bold mb-3 text-center">Driver Details</h3>

                                        <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                            <label class="form-label text-center" for="validationCustom02">Name</label>
                                            <input class="form-control btn-square" type="text" readonly value="{{$driverName}}" />
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                            <label class="form-label text-center" for="validationCustom02">Phone</label>
                                            <input class="form-control btn-square" type="text" value="{{$driverPhnum}}" readonly />
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                            <label class="form-label text-center" for="validationCustom02">Address</label>
                                            <input type='text' class="form-control btn-square" readonly value="{{$driverAddr}}" />
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="input-text-1">License No</label>
                                            <input type="text" class="form-control btn-square" readonly value="{{$driverLicenseNum}}" />
                                        </div>
                                        
                                        <!--<div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                            <label class="form-label text-center" for="validationCustom02">License Image</label>
                                            <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$driverLicensePhoto}}" style="width: 150px; height:80px" />
                                        </div>-->
                                        
                                        
                                        <div class="col-lg-6 col-sm-12 mb-3  mt-2">
                                            <label for="input-text-1">Aadhar Number</label>
                                            <input type="text" class="form-control btn-square" value="{{$driverAadharNum}}" readonly />
                                        </div>
                                        
                                        <!--<div class="col-lg-6 col-sm-12 mb-3  mt-2">
                                            <label class="form-label " for="validationCustom02">Aadhar Image</label>
                                            <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$driverAadharImg}}" style="width: 150px; height:80px" />
                                        </div>-->

                                        <div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                            <label class="form-label text-center" for="validationCustom02">QR Code</label>
                                            <img class="form-control btn-square" src="{{asset('uploads/')}}/{{$qrc}}" style="width:200px; height:200px" />
                                        </div>
                                        
                                        <!--<div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                            <label class="form-label" for="validationCustom02">Password</label>
                                            <input class="form-control btn-square" id="input-text-16" type="password" name="pswd" placeholder="Enter the password" required="" />
                                            <div class="invalid-feedback">Please enter the password</div>
                                        </div>
                                        
                                        <div class="col-md-12 input-style-always-active has-borders no-icon mb-4">
                                            <div class="form-check icon-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="check3" checked="" required>
                                                <label class="form-check-label" for="check3">I Accept all <a href="{{route('terms.conditions')}}" target="_blank" class="color-highlight">Terms & Conditions</a></label>
                                                <i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
                                                <i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
                                            </div>
                                        </div>-->
                                    </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-lg-4 col-sm-12 mb-3 draggable">
                                <label class="form-label " for="validationCustom02">Vehicle Photo</label>
                                <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$vehPhoto}}" style="width: 150px; height:80px" />
                            </div>
                            
                            <div class="col-lg-4 col-sm-12" >
                                 <label class="form-label" for="validationCustom02">Owner Photo</label>
                                 <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$ownerPhoto}}" style="width: 150px; height:80px" />
                            </div>
                            
                            <div class="col-lg-4 col-sm-12" >
                                <label class="form-label " for="validationCustom02">Owner Aadhar Image</label>
                                <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$ownerAadharImg}}" style="width: 150px; height:80px" />
                            </div><br><br>
                            
                            <div class="col-lg-4 col-sm-12">
                                <label class="form-label text-center" for="validationCustom02">Driver License Image</label>
                                <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$driverLicensePhoto}}" style="width: 150px; height:80px" />
                            </div>
                            
                            <div class="col-lg-4 col-sm-12" >
                                <label class="form-label" for="validationCustom02">Driver Aadhar Image</label>
                                <img class="form-control btn-square" src="{{asset('uploads/customer')}}/{{$driverAadharImg}}" style="width: 150px; height:80px" />
                            </div>
                            </div>
                        </div>
                      </div>

                    </div>
                              </div>
                              
                              
                              
                              <!-- Server Side Processing start-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                     
                    <div class="mb-3 text-end">
                        <!-- <a href="{{route('admincomplaints.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Vehicles</button>
                        </a> -->
                    </div>
                   </div>



                    <h3 class='p-3'>History</h3>


                   <!--<div class="row d-inline-flex m-2">
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Zone<span class="text-danger fs-6">*</span> </label>
                        <select class="custom-select form-select" name="zone" id="chosen_zone">
                            <option value="">Select...</option>
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
                      </div>
                      
                      
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Division <span class="text-danger fs-6">*</span></label>
                        <select class="custom-select form-select" name="mlac" id="chosen_mlac">
                            <option value="">Select...</option>
                        </select>
                      </div>
                      
                      
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select ward<span class="text-danger fs-6">*</span> </label>
                        <select class="custom-select form-select" name="ward" id="chosen_ward">
                            <option value="">Select...</option>
                        </select>
                      </div>
                      
                      
                      <div class="col-lg-3 col-sm-12 mb-3 draggable">
                        <label class=" col-form-label validationCustom04">Select Status </label>
                        <select class="custom-select form-select" id="validationCustom04">
                          <option value="">Select...</option>
                          <option value="1">Progress</option>
                          <option value="2">Picked Up</option>
                          <option value="3">Dumped</option>
                        </select>
                      </div>
                    </div>-->




                  <div class="card-body m-3">
                    <div class="table-responsive">
                     
                      <table class="display" id="regd_veh_history" style="width:100%">
                        <thead>
                          <tr>
                              <!-- Old set of table headings -->
                              
                              <th>ID</th>
                              <th>Vehicle No</th>
                              <th>Waste Type</th>
                              <th>Picked On</th>
                              <th>Dumped On</th>
                              <th>Status</th>
                              <!--<th>Actions</th>-->
                              
                              <!-- New set of table headings -->
                            
                              <!--<th>#</th>
                              <th>Vehicle No</th>
                              <th>Driver Name</th>
                              <th>Owner Name</th>
                              <th>Status</th>-->
                          </tr>
                        </thead>
                      </table>
                     
                    </div>
                  </div>
                </div>
              </div>
              <!-- Server Side Processing end-->
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
    
                var table = $('#regd_veh_history').DataTable({
				
				    processing:true,
					serverSide:true,
					ajax: {
						url: "{{ url('/admin/regdVehsHistory/'.$custID) }}"
					},
					columns: [
					    
					    // Old dataset for this regd veh history
					    
						{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
						{ data: 'Vehicle_num', name: 'Vehicle_num' },
						{ data: 'waste', name: 'waste' },
                        { data: 'Picked_up_on', name: 'Picked_up_on' },
                        { data: 'Dumped_on', name: 'Dumped_on' },
						{ data: 'status', name: 'status' },
					    //{data: 'action', name: 'action'},
					    
					    // New dataset for this regd veh history
					    
					    /*{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
						{ data: 'Vehicle_num', name: 'Vehicle_num' },
						{ data: 'Driver_name', name: 'Driver_name' },
                        { data: 'Owner_name', name: 'Owner_name' },
						{ data: 'status', name: 'status'},*/
					],
					order:[],
					responsive: true
				
				});
				
				
				/*$('#chosen_zone').on('change', function() 
                {
                    var zone_num = this.value;
                    $("#chosen_mlac").html('');
                    $('#chosen_ward').html('');
            
                    $.ajax({
                        url:"{{url('get-divisions')}}",
                        type: "GET",
            
                        data: 
                        {
                            zoneNum: zone_num,
                            _token: '{{csrf_token()}}' 
                        },
            
                        dataType : 'json',
            
                        success: function(result)
                        {
                            $('#chosen_mlac').html('<option value="">Select...</option>'); 
                            $("#chosen_ward").html('<option value="">Select...</option>');
                            
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
                        url:"{{url('get-wards')}}",
                        type: "GET",
            
                        data: 
                        {
                            divisionNum: mlac_num,
                            _token: '{{csrf_token()}}' 
                        },
            
                        dataType : 'json',
            
                        success: function(result)
                        {                 
                            $('#chosen_ward').html('<option value="">Select...</option>'); 
                            
                            $.each(result.wards,function(key,value)
                            {
                                $("#chosen_ward").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                        }            
                    });
                });*/
				
				
				
				// Updates DELETE SCRIPT
				$('body').on('click', '#show-delete', function () {
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
					
				});
				
			});
        
    </script>
    
    	

  
@endsection