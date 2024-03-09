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
                  <h3>Breeding Spot</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">   <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Breeding Spot</li>
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
                     
                   </div>




                  <div class="card-body m-3">
                    <div class="table-responsive">
                     
                      <table class="display" id="pickup_info" style="width:100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>UID</th>
                            <th>Reporter Name</th>
                            <th>Type of container</th>
                            <th>Image</th>
                            <th>Remarks</th>
                            <th>Date</th>
                            <!--<th>Status</th>
                            <th>Action</th>-->
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
                                <td>
                                    @php
                                    $cdetails = DB::table('customers')->where('id', $data->cust_id)->first();
                                    @endphp
                                    {{$cdetails->username}}
                                </td>
                                <td>{{$data->waste}}</td>
                                <td>
                                    <?php
                                    if(!empty($data->image_data))    
                                    echo '<img src="'.asset('uploads/pick/' . $data->image_data).'" class="rounded-circle" width="100" height="100" alt="No image">';
                                    else
                                    echo '<img alt="Image not found">';
                                    ?>
                                </td>
                                
                                <td>
                                    <?php
                                    if(!empty($data->descp))  
                                    echo '<p>'.$data->descp.'</p>';
                                    
                                    else
                                    echo "Not available";
                                    ?>
                                </td>
                                
                                <td>
                                    <?php
                                    $pickUpTSArr = explode(" ", $data->created_at);
                                    $pickUpDate = $pickUpTSArr[0];
                                    
                                    echo '<p>'.date("d/m/Y", strtotime($pickUpDate)).'</p>';
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
                                <td>{{$z}}</td>
                                <td>{{$data->uid}}</td>
                                <td>
                                    @php
                                    $cdetails = DB::table('customers')->where('id', $data->cust_id)->first();
                                    @endphp
                                    {{$cdetails->username}}
                                </td>
                                <td>{{$data->waste}}</td>
                                <td>
                                    <?php
                                    if(!empty($data->image_data))    
                                    echo '<img src="'.asset('uploads/pick/' . $data->image_data).'" class="rounded-circle" width="100" height="100" alt="No image">';
                                    else
                                    echo '<img alt="Image not found">';
                                    ?>
                                </td>
                                
                                <td>
                                    <?php
                                    if(!empty($data->descp))  
                                    echo '<p>'.$data->descp.'</p>';
                                    
                                    else
                                    echo "Not available";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if(!empty($data->phone))  
                                    echo '<p>'.$data->phone.'</p>';
                                    
                                    else
                                    echo "Not available";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $pickUpTSArr = explode(" ", $data->created_at);
                                    $pickUpDate = $pickUpTSArr[0];
                                    
                                    echo '<p>'.date("d/m/Y", strtotime($pickUpDate)).'</p>';
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
    
    
    
                var table = $('#pickup_info').DataTable();
				
				
				
				
				
			});
        
    </script>
    
    	

  
@endsection