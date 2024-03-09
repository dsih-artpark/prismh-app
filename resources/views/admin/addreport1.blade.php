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
                  <h3>Reports</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">         <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Inspection</li>
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
                      <h5>Breeding Spot Analysis</h5>
                       
<div class="text-end ">
  <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-calendar" aria-hidden="true"></i> Months</button>
  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
    <li><a class="dropdown-item active" href="{{route('admin.inspection.months', ['id'=>1])}}">January</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>2])}}">February</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>3])}}">March</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>4])}}">April</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>5])}}">May</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>6])}}">June</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>7])}}">July</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>8])}}">August</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>9])}}">September</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>10])}}">October</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>11])}}">November</a></li>
    <li><a class="dropdown-item" href="{{route('admin.inspection.months', ['id'=>12])}}">December</a></li>
  </ul>
</div>
       
                   </div>
                  <div class="card-body">
                    <div class="table-responsive">
                     
                      <table class="display" id="subcategory" style="width:100%">
                        <thead>
                          <tr>
                           <th></th>
                            <th></th>
                            <th colspan="{{$daysInMonthth}}">{{$monthdetth}}
                            <tr>
                           <th>Sl. No.</th>
                            <th>Ward Name</th>
                           @for ($day = 1; $day <= $daysInMonthth; $day++)
                <th>{{ $day }}</th>
            @endfor
                          </tr>
                            </th>
                            
                          </tr>
                          
                        </thead>
                        <tbody>
                          @php
                          $i = 1;
                          @endphp
                          @foreach($reports as $subcat)
                          <tr>
                          <td>{{$i}}</td>
                          <td>{{$subcat->name}}</td>
                          <!--$reports = DB::table('ticket_mng2')->select('ticket_mng2.*')->join('customers','ticket_mng2.cust_id','=', 'customers.id', 'left')->where('customers.roles',1)->get();-->
        

                           @for ($day = 1; $day <= $daysInMonth; $day++)
                            <td>
                                @php
                                
                                     $day = str_pad($day, 2, '0', STR_PAD_LEFT);
                                    $ddt = $currentYear.'-'.$currentMonth.'-'.$day;
                                    $insid = $subcat->id;
                                    $insdetails = DB::table('pick')->where('ward',$insid)->where('q1','=','Yes')->where('created_at','like', $ddt.'%')->get();
                                    
                                 $cday = \Carbon\Carbon::now()->format('Y-m-d');
                                @endphp
                                @if($cday < $ddt)
                                
                                <span class="text-dark">-</span>
                               
                                 @else
                                 @if($insdetails)
                               
                               
                                <span class="text-danger">{{$insdetails->count()}}</span>
                                @else
                                <span class="text-danger">0</span>
                                
                                @endif
                                
                                @endif
                            </td>
                        @endfor
                          
                          
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
    
                var table = $('#subcategory').DataTable({
					
				});
				
				
				
			});
        
    </script>
    
    	

  
@endsection