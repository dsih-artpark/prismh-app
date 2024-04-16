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
                  <h3>Users</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">         <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Users</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <div class="row pt-4">
              <div class="col-xl-4 col-md-12 box-col-12">
                <div class="card o-hidden">
                  <div class="chart-widget-top">
                    <div class="card-body pb-0">
                      <div class="row">
                        <div class="col-5">
                        <i class="fa fa-ticket font-default p-2 mb-3 " style="font-size:20px;border-radius:20px;" aria-hidden="true"></i>
                          <h6 class="f-w-600 font-default mb-4">ALL</h6>
                        </div>
                        <div class="col-7 text-end">
                         <?php $count = DB::table('customers')->where('roles', 2)->count();?> 
                            
                            
                           <h4 class="num total-value mt-3">{{$count}}</h4> 
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
             
              
            </div>
            <div class="row">
              <!-- Server Side Processing start-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                      <h5>Users list</h5>
                      <div class="mb-3 text-end">
                        <a href="{{route('adminusers.add')}}">
                        <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Users</button> 
                        </a>
                    </div>
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="survey" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Ward</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php 
                          $i = 1;
                          @endphp
                          @foreach($data as $my_tck)
                          <tr>
                            <td>{{$i}}</td>
                             <td>{{$my_tck->username}}</td> 
                            <td>{{$my_tck->phone}}</td>
                            <td>
                                @php 
                                $wards = explode(',',$my_tck->ward);
                                @endphp
                                <ul>
                                     @foreach($wards as $ward)
                                    @php 
                          $warddatas = DB::table('ward')->where('id',$ward)->first();
                          @endphp 
                                <li>{{$warddatas->name}}</li>
                                    @endforeach
                                </ul>
                                
                            </td>
                            
                            <td>
                                
                                <div class="dropdown-basic">
                      <div class="dropdown">
                        
                         @if($my_tck->status == 1)
                         <button class="dropbtn btn-success btn-round btn-1x" type="button">Approved</button>
                            @elseif($my_tck->status == 2)
                            <button class="dropbtn btn-danger btn-round btn-1x" type="button">Not&nbsp;Approved</button>
                            @elseif($my_tck->status == 3)
                            <button class="dropbtn btn-primary btn-round btn-1x" type="button">Registered</button>
                           @else
                           <button class="dropbtn btn-default btn-round btn-1x" type="button">Not defined</button>
                            
                            @endif
                        <div class="dropdown-content">
                            <a href="{{route('adminusersapprovals.id', ['id'=>$my_tck->id , 'sts'=>1])}}" class="text-success"> Approved</a>
                            <a href="{{route('adminusersapprovals.id', ['id'=>$my_tck->id , 'sts'=>2])}}"  class="text-danger">Not Approved</a>
                        </div>
                      </div>
                    </div>
                            </td>
                                
            
                            <td>
                            <a href="{{route('adminusers.edit' , $my_tck->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
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
            
             <div class="row">
              <!-- Server Side Processing start-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                      <h5>Asha Workers</h5>
                      
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="asha" style="width:100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Ward</th>
                            <th>Status</th>
                            <th>ID Card</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php 
                          $i = 1;
                          $ashadatas = DB::table('customers')->where('roles','=',1)->get();
                          @endphp
                          @foreach($ashadatas as $my_tck)
                          <tr>
                            <td>{{$i}}</td>
                             <td>{{$my_tck->username}}</td> 
                            <td>{{$my_tck->phone}}</td>
                            <td>
                               @php 
                          $warddatas = DB::table('ward')->where('id',$my_tck->ward)->first();
                          @endphp 
                          @if($warddatas)
                                {{$warddatas->name}}
                                @endif
                            </td>
                            
                            <td>
                              <div class="media-body text-center switch-sm">
                              @if($my_tck->status == 1)
                                <!-- <button class=" btn-success btn-round btn-1x" type="button">Approved</button> -->
                                <label class="switch">
                                  <input type='checkbox' checked onchange="changeStatus({{$my_tck->id}})">
                                  <span class="switch-state"></span>
                                </label>
                              @else
                                <label class="switch">
                                  <input type='checkbox' onchange="changeStatus({{$my_tck->id}})">
                                  <span class="switch-state"></span>
                                </label>
                                <!-- <button class=" btn-default btn-round btn-1x" type="button">Not defined</button> -->
                              @endif                     
                              </div>
                     
                            </td>

                            <td>
                              @php $img_name = explode('/', $my_tck->id_card); @endphp
                              @if($my_tck->id_card) {{end($img_name)}} @endif
                            </td>
                                
                            <td>
                            <a href="{{route('adminusers.edit' , $my_tck->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
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
   
<script src="{{asset('admin/assets/js/notify/bootstrap-notify.min.js')}}"></script>
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
    
                var table = $('#survey').DataTable();
                
                var table = $('#asha').DataTable();
				
				
			
				
      });
    function changeStatus(id){
      $.ajax({
        method: "POST",
        url: "{{ route('adminusers.update_status') }}",
        data: {_token: "{{csrf_token()}}", id: id},              
      })
      .done(function (res) {
        if(res.success){
          show_notify(res.message);
        }
      })
      .fail(function (err) {
        console.log(err);            
      });
    }
        
    </script>
    
  <script>
    function show_notify(title){
      $.notify(
        {
          title:title,
          message:''
        },
        {
          type:'info',
          newest_on_top:true ,
          showProgressbar:false,
          spacing:10,
          timer:3000,
          placement:{
            from:'top',
            align:'right'
          },
          delay:1000 ,
          z_index:10000,
          animate:{
            enter:'animated flash',
            exit:'animated flash'
          }
        }
      );
      }
 </script>

  
@endsection