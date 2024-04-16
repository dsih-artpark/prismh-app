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
                  <h3>Larva Survey</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">   <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Larva Survey</li>
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
                  <div class="card-body m-3">
                    <div class="table-responsive">
                    <table id='dump_info' class="display" style='width:100%;'>
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>UID</th>
                              <th>Asha Worker Name</th>
                              <th>Breeding Spot</th>
                              <th>Image</th>
                              <th>Within Ward</th>
                              <th>Remarks</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                     {{--
                      <table class="display" id="" style="width:100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>UID</th>
                            <th>Asha Worker Name</th>
                            <th>Breeding Spot</th>
                            <th>Image</th>
                            <th>Remarks</th>
                            <th>Date</th>
                            <!--<th>Status</th>-->
                            <th>Action</th>
                          </tr>
                          <tbody>
                               @php 
                            $z = 1; 
                            
                            @endphp
                             
                            
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$z}}</td>
                                <td>{{$data->uid}}</td>
                                <td class="text-capitalize">
                                    {{$data->username}}
                                </td>
                                <td class="text-capitalize">
                                    {{$data->q1}}
                                </td>
                                <td>
                                    <?php
                                    if(!empty($data->image_data))    
                                    echo '<img src="'.asset('uploads/pick/' . $data->image_data).'" class="rounded-circle" width="80" height="80" alt="No image">';
                                    else
                                    echo '<img alt="Image not found">';
                                    ?>
                                </td>
                                <td >
                                    @if($data->descp)
                                    {{$data->descp}}
                                    
                                    @else
                                   -
                                    @endif
                                </td>
                                <td>
                                    {{date("d/m/Y", strtotime($data->created_at))}}
                                    
                                </td>
                                <td>
                                    
                                    <a href="{{route('admin.breedingspots.view' , ['id' => $data->id])}}" class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>
                                    
                                </td>
                            </tr>
                            
                             @php $z++; @endphp
                            @endforeach
                        
                        
                          </tbody>
                        </thead>
                      </table>
                      <div class="float-end mt-2 pb-2">
                          {{$datas->links('pagination::bootstrap-4')}}
                      </div>
                      --}}
                     
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
    
    
    
                // var table = $('#dump_info').DataTable({
                //      dom: '<"top">lft<"bottom">i<"clear">'
                // });

                $('#dump_info').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: "{{route('admin.get.survey')}}",
                    order: [[0, 'desc']],
                    columns: [
                        { data: 'id' },
                        { data: 'uid' },
                        { data: 'username' },
                        { data: 'q1' },
                        { data: 'image_data' },
                        { data: 'within_ward' },
                        { data: 'descp' },
                        { data: 'created_at' },
                        { data: 'action' },
                    ]
                });
				
				
				
				
			});
        
    </script>
    
    	

  
@endsection