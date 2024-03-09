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
                  <h3>Waste Information</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">   <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Waste Information</li>
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
                        <label class=" col-form-label validationCustom04">Select Status </label>
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
                     
                      <table class="display" id="waste_info" style="width:100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Vehicle No</th>
                            <th>Waste Type</th>
                            <th>Picked On</th>
                            <th>Dumped On</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                <td>{{$data->vehicle_num}}</td>
                                <td>{{$data->waste_type}}</td>
                                <td>
                                    @php
                                    $pickUpDate = date("d/m/Y", strtotime($data->waste_picked_up_on));
                                    @endphp
                                   {{$pickUpDate}} 
                                </td>
                                <td>
                                    @php
                                    $pickUpDate = date("d/m/Y", strtotime($data->waste_dumped_on));
                                    @endphp
                                    {{$pickUpDate}} 
                                </td>
                                <td>
                                    <?php
                                    if($data->status != null){

                if($data->status == 1){
                    echo 'Progress';    
                }

                else if($data->status == 2){
                    echo 'Picked Up';    
                }
                    
                else{
                    echo 'Dropped';
                }
                }                   
                ?>
                
                                </td>
                                <td>
                                    <div class = "">
                                    <?php
                                    $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "View")
                       {
            echo '<a href="'.url('admin/wasteInfo/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                       }
                      }
                      if($rolid == 1){
                          
                           echo '<a href="'.url('admin/wasteInfo/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                      }
            ?>
            
            
            </div>
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
                                <td>{{$data->vehicle_num}}</td>
                                <td>{{$data->waste_type}}</td>
                                <td>
                                    @php
                                    $pickUpDate = date("d/m/Y", strtotime($data->waste_picked_up_on));
                                    @endphp
                                   {{$pickUpDate}} 
                                </td>
                                <td>
                                    @php
                                    $pickUpDate = date("d/m/Y", strtotime($data->waste_dumped_on));
                                    @endphp
                                    {{$pickUpDate}} 
                                </td>
                                <td>
                                    <?php
                                    if($data->status != null){

                if($data->status == 1){
                    echo 'Progress';    
                }

                else if($data->status == 2){
                    echo 'Picked Up';    
                }
                    
                else{
                    echo 'Dropped';
                }
                }                   
                ?>
                                </td>
                                <td>
                                    <div class = "">
                                    <?php
                                    $rolid = session('admin.admin_id');
                      if($rolid > 1){
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "View")
                       {
            echo '<a href="'.url('admin/wasteInfo/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                       }
                      }
                      if($rolid == 1){
                          
                           echo '<a href="'.url('admin/wasteInfo/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                      }
            ?>
            
            
            </div>
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

        
		
		var table = $('#waste_info').DataTable();
				
	


      
        $('#chosen_zone').on('change', function() 
    {
        var zone_num = this.value;
        $("#chosen_mlac").html('');
        $('#chosen_ward').html('');

        $.ajax({
            url:"{{url('get-divisions-for-complaints')}}",
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
        
        getZoneWiseWasteInfo(zone_num);
    }); 


    $('#chosen_mlac').on('change', function() 
    {
        var mlac_num = this.value;        
        $("#chosen_ward").html('');

        $.ajax({
            url:"{{url('get-wards-for-complaints')}}",
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
    
    
    
    <script>
    function getZoneWiseWasteInfo(zone_id)
    {
        //alert(zone_id);
        
        
    }
    </script>
    	

  
@endsection