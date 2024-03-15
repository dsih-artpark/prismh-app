
@extends('admin.main')

@section('menubar_script')
@parent
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/prism.css') }}">
    
    <style>
        div.dt-buttons {
position: relative;
float: right;
margin-bottom: 10px;
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
    @php
    
   
    $startDateOfWeek = \Carbon\Carbon::now()->startOfWeek();
$endDateOfWeek = \Carbon\Carbon::now()->endOfWeek();

$weeklyCount = DB::table('pick')
    ->where('status', 1)
    ->whereBetween('created_at', [$startDateOfWeek, $endDateOfWeek])
    ->count();

// Monthly Count
$startDateOfMonth = \Carbon\Carbon::now()->startOfMonth();
$endDateOfMonth = \Carbon\Carbon::now()->endOfMonth();

$monthlyCount = DB::table('pick')
    ->where('status', 1)
    ->whereBetween('created_at', [$startDateOfMonth, $endDateOfMonth])
    ->count();
    
    
    
    
    $pickdetails =  DB::table('pick')->where('status', 1)->count();
    
    
    $sourceredcount =  DB::table('pick')->where('source_reduction','Done')->where('status', 1)->count();
    
    $breedspt =  DB::table('pick')->where('q1','=','Yes')->where('status', 1)->count();
    
    $dumpdetails =  DB::table('dump')
                    ->join('pick', 'dump.pid','=', 'pick.id','left')
                    ->where('pick.q1','=','Yes')
                    ->count();
                    
    $unmatchedCountt = DB::table('pick')
                        ->select('pick.id')
                        ->leftJoin('dump', 'pick.id', '=', 'dump.pid') 
                         ->where('pick.q1','=','Yes')
                         ->where('pick.source_reduction','=','Not Done')
                        ->whereNull('dump.id') 
                         ->groupBy('pick.id')
                        ->get();
                        
     $pending =  $unmatchedCountt->count();                  
                        
    $wardscount =  DB::table('pick')->select('ward')->where('status', 1)->groupBy('ward')->get();
   $wardcnt = $wardscount->count();
   
    @endphp
   
    <div class="container-fluid">
             <!--dd($wardscount);-->

            <!-- Chart widget top Start-->
            <div class="row pt-4">
              <div class="col-xl-4 col-sm-4 box-col-4">
                <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
                  <div class="card-body">
                       <div class="media">
                        <div class="social-font">
                            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                        </div>
                      <div class="media-body">
                        <h4>Houses Surveyed</h4>
                      </div>
                    </div>
                      
                    
                  </div>
                  <div class="card-footer">
                   <div class="row">
                      <div class="col text-center">
                      <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$pickdetails}}</h5>
                        <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</h6>   
                      </div>
                      <div class="col text-center">
                      <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$weeklyCount}}</h5>
                        <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Weekly</h6>   
                      </div>
                      <div class="col text-center">
                      <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$monthlyCount}}</h5>
                        <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Monthly</h6>   
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-4 box-col-4">
                <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
                  <div class="card-body">
                       <div class="media">
                        <div class="social-font">
                            <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                        </div>
                      <div class="media-body">
                        <h4>Wards Covered</h4>
                      </div>
                    </div>
                      
                    
                  </div>
                  <div class="card-footer">
                   <div class="row">
                      
                      <div class="col text-center">
                      <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$wardcnt}}</h5>
                        <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</h6>   
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-4 box-col-4">
                <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
                    <div class="card-body">
                        <div class="media">
                      <div class="social-font">
                          <i class="fa fa-bug fa-2x" aria-hidden="true"></i>
                        </div>
                      <div class="media-body">
                        <h4>Breeding Spots</h4>
                      </div>
                    </div>
                    
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col text-center">
                      <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$breedspt}}</h5>
                        <h6 class="font-roboto" style="font-weight:600px;font-size:18px;">Total</h6>  
                      </div>
                      <!--<div class="col text-center">-->
                      <!--<h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$sourceredcount}}</h5>-->
                      <!--  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Source Reduction</h6>  -->
                      <!--</div>-->
                      <!--<div class="col text-center">-->
                      <!--<h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$dumpdetails}}</h5>-->
                      <!--  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;">Sprayed</h6>   -->
                      <!--</div>-->
                      <!--<div class="col text-center">-->
                      <!--  <h5 class="counter mb-0 font-roboto font-primary"style="font-size:25px;text-wrap:nowrap;">{{$pending}}</h5>-->
                      <!--  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;">Pending</h6>-->
                      <!--</div>-->
                    </div>
                  </div>
                </div>
              </div>
               
              
              
              
             
               
            </div>
            
            
            <div class="row">
              <div class="col-xl-8 col-md-8 box-col-8">
                <div class="card" style=" box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
                  <div class="chart-widget-top">
                    <div class="card-body p-2" style="min-height:324px;">
                      <div id="map" style="min-height:310px;border-radius: 15px">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-sm-4 box-col-4">
                <div class="card " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
                  <div class="card-header pb-0">
                      <h5 class=""> Inactive Asha Workers </h5>
                      </div>
                      <div class="card-body pt-2 p-4">
                          <div class="table-responsive" style="max-height:240px;">
                     
                      <table class="display" id="content" style="width:100%">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Ward</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                            $cust =  DB::table('customers')
                                        ->select('customers.*')
                                        ->leftJoin('pick', 'customers.id', '=', 'pick.cust_id','left') 
                                        ->where('customers.roles', 1)
                                        ->whereNull('pick.cust_id')
                                        ->get();
                            
                            @endphp
                            
                            @foreach($cust as $custdet)
                            <tr>
                            <td>{{$custdet->username}}</td>
                            <td>
                                @php
                            $wrd =  DB::table('ward')->where('id', $custdet->ward)->first();
                            
                            @endphp
                            @if($wrd)
                            {{$wrd->name}}
                            @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                      
                      
                      
                      
                    </div>
                      </div>
                    </div>
              </div>
            
            </div>
            <div class="row">
              
             <div class="col-xl-12 col-sm-12 box-col-12">
                <div class="card ">
                  <div class="card-header">
                      <h5 class=""> Zone Wise Analysis </h5>
                      </div>
                      <div class="card-body p-4">
                          <div class="table-responsive p-1">
                     
                      <table class="display p-2" id="zone" style="width:100%">
                        <thead>
                          <tr>
                              <th>#</th>
                            <th>Zone</th>
                            <th>Houses surveyed</th>
                            <th>Breeding Spot</th>
                            <!--<th>Sprayed</th>-->
                          </tr>
                        </thead>
                        <tbody>
                            @php
                            
                                            
                                            
                                            $zonedetails = DB::table('zone')->get();
                                            
                                          
                                          
                            $i=1;
                            @endphp
                            
                            @foreach($zonedetails as $ward)
                            
                           
                            <tr>
                            <td>
                                {{$i}}
                            </td>
                            <td>{{$ward->title}}</td>
                            <td>
                            @php
                            
                              
                            $suryd =  DB::table('pick')
                                    ->join('ward','pick.ward','=','ward.id','left')
                                    ->join('division','ward.division_id','=','division.id','left')
                                    ->join('zone','division.zone_id','=','zone.id','left')
                                    ->where('zone.id',$ward->id)->where('pick.status', 1)->get();
                                    
                            
                            
                         
                                    
                            @endphp
                            {{$suryd->count()}}
                                </td>
                            <td>
                                @php
                                $breedsptc =  DB::table('pick')
                                            ->join('ward','pick.ward','=','ward.id','left')
                                    ->join('division','ward.division_id','=','division.id','left')
                                    ->join('zone','division.zone_id','=','zone.id','left')
                                    ->where('zone.id',$ward->id)->where('pick.q1','=','Yes')->where('pick.status', 1)->get();
                                @endphp
                                {{$breedsptc->count()}}
                            </td>
                         
                            @php
                            $i++;
                            @endphp
                          </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                      
                      
                      
                      
                    </div>
                      </div>
                    </div>
                </div>
            </div>
            
            
                
           
            
          </div>
    
        
        </div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent



  
  

  
   <script src="{{ asset('admin/assets/js/chart/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('admin/assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('admin/assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('admin/assets/js/owlcarousel/owl-custom.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboard/dashboard_2.js') }}"></script>
    <!--<script src="{{ asset('admin/assets/js/chart-widget.js') }}"></script>-->
    <script src="{{ asset('admin/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{ asset('admin/assets/js/chart/apex-chart/chart-custom.js')}}"></script>
    


    <script src="{{ asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable-extension/custom.js') }}"></script>
    
    
       <script type="text/javascript">

			"use strict";

		 $(document).ready(function(){
		     
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
    
                var table = $('#content').DataTable({
                     dom: '<"top">t<"bottom"><"clear">'
                });
                 $('#zone').DataTable(
                     );

     });
  </script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzhEbRtsoayqY94uOYInJIPCJp5Y6e7cY&callback=initMap&libraries=&v=weekly" async> </script>

<script>
  function initMap() {
    // var locations = [
    //   [12.972442, 77.58064],
    //   [12.972442, 77.58064],
    // ];
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: new google.maps.LatLng(12.972442, 77.580643),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });    
    var infowindow = new google.maps.InfoWindow();
    var marker, i;   
    const green_marker =  "http://maps.google.com/mapfiles/ms/micons/green-dot.png";
    // for (i = 0; i < locations.length; i++) {  
      @foreach($locations as $location)
        @if($location->latit)        
          @if($location->source_reduction == 'Done')
            marker = new google.maps.Marker({
              // position: new google.maps.LatLng(locations[i][0], locations[i][1]),
              position: new google.maps.LatLng({{explode(',', $location->latit)[0]}}, {{explode(',', $location->latit)[1]}}),
              map: map,
              icon: green_marker
            });
          @else
            marker = new google.maps.Marker({
              // position: new google.maps.LatLng(locations[i][0], locations[i][1]),
              position: new google.maps.LatLng({{explode(',', $location->latit)[0]}}, {{explode(',', $location->latit)[1]}}),
              map: map,
            });
          @endif
          // google.maps.event.addListener(marker, 'click', (function(marker, i) {
          //   return function() {
          //     infowindow.setContent(locations[i][0]);
          //     infowindow.open(map, marker);
          //   }
          // })(marker, i));
        @endif
      @endforeach
    // }
  }
</script>
@endsection